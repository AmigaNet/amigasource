<?php

namespace AmigaSource\Data;

class LinkEngine
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function delete($linkId)
    {
        $sql = "DELETE FROM links WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $linkId);
        $stmt->execute();

        $sql = "DELETE FROM links_categories WHERE link_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $linkId);
        $stmt->execute();
    }

    public function fetch($linkId)
    {
        $sql = "SELECT * FROM links WHERE id = $linkId LIMIT 1";
        $result = $this->db->query($sql);

        if ($result->num_rows == 0) {
            throw new \Exception("Link not found");
        }

        $link = $result->fetch_assoc();

        $link['categories'] = $this->getCategoriesForLink($linkId);

        return $link;
    }

    public function fetchAll()
    {
        $sql = "SELECT * FROM links ORDER BY `name` ASC";
        $result = $this->db->query($sql);
        $links = [];
        while ($row = $result->fetch_assoc()) {
            $links[] = $row;
        }
        return $links;
    }

    public function fetchByCategory($categoryId)
    {
        $sql = "SELECT l.* FROM links AS l INNER JOIN links_categories AS lc ON l.id = lc.link_id INNER JOIN categories AS c ON lc.category_id = c.id WHERE c.id = $categoryId ORDER BY l.`name` ASC";
        $result = $this->db->query($sql);
        $links = [];
        while ($row = $result->fetch_assoc()) {
            $links[] = $row;
        }
        return $links;
    }

    public function fetchHighestRated()
    {
        $sql = "SELECT * FROM links WHERE is_active = 1 ORDER BY rating DESC LIMIT 10";
        $result = $this->db->query($sql);
        $links = [];
        while ($row = $result->fetch_assoc()) {
            $links[] = $row;
        }
        return $links;
    }

    public function fetchSubmitted()
    {
        $sql = "SELECT l.*, u.username FROM links l INNER JOIN users u ON l.submitter_id = u.id WHERE l.is_active = 0 AND l.submitter_id != 0 ORDER BY `name` ASC";
        $result = $this->db->query($sql);
        $links = [];
        while ($row = $result->fetch_assoc()) {
            $links[] = $row;
        }

        return $links;
    }

    public function getCategoriesForLink($linkId)
    {
        $sql = "SELECT c.* FROM categories AS c INNER JOIN links_categories AS lc ON c.id = lc.category_id INNER JOIN links AS l ON lc.link_id = l.id WHERE l.id = $linkId ORDER BY c.`name` ASC";
        $result = $this->db->query($sql);
        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
        return $categories;
    }

    public function insertLink($name, $url, $author, $email, $description, $is_active, $is_dead, $is_recommended, $categories)
    {
        $sql = "INSERT INTO links (`name`, `url`, `author`, `email`, `description`, `is_active`, `is_dead`, `is_recommended`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('sssssiii', $name, $url, $author, $email, $description, $is_active, $is_dead, $is_recommended);
        $stmt->execute();
        $linkId = $this->db->insert_id;
        foreach ($categories as $categoryId) {
            $sql = "INSERT INTO links_categories (link_id, category_id) VALUES ($linkId, $categoryId)";
            $this->db->query($sql);
        }
        return $linkId;
    }

    public function search($query)
    {
        $query = $this->db->real_escape_string($query);
        $query = "%$query%";
        $sql = "SELECT * FROM links WHERE `name` LIKE ? OR `url` LIKE ? OR `description` LIKE ? ORDER BY `name` ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('sss', $query, $query, $query);
        $stmt->execute();
        $result = $stmt->get_result();
        $links = [];
        while ($row = $result->fetch_assoc()) {
            $links[] = $row;
        }
        return $links;
    }

    public function searchAdvanced($query, $field)
    {
        $query = "%$query%";
        $sql = "SELECT * FROM links WHERE `$field` LIKE ? ORDER BY `name` ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('s', $query);
        $stmt->execute();
        $result = $stmt->get_result();
        $links = [];
        while ($row = $result->fetch_assoc()) {
            $links[] = $row;
        }

        return $links;
    }

    public function suggestLink($name, $url, $author, $email, $description, $categories, $submitter_id)
    {
        $sql = "INSERT INTO links (`name`, `url`, `author`, `email`, `description`, `submitter_id`, `is_active`) VALUES (?, ?, ?, ?, ?, ?, 0)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('sssssi', $name, $url, $author, $email, $description, $submitter_id);
        $stmt->execute();
        $linkId = $this->db->insert_id;
        foreach ($categories as $categoryId) {
            $sql = "INSERT INTO links_categories (link_id, category_id) VALUES ($linkId, $categoryId)";
            $this->db->query($sql);
        }
        return $linkId;
    }

    public function testForBroken($linkId)
    {
        $link = $this->fetch($linkId);

        $url = $link['url'];

        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            if ($link['is_dead'] == 0) {
                $sql = "UPDATE links SET is_dead = 1, is_active = 0 WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->bind_param('i', $linkId);
                $stmt->execute();
                return;
            }
            return;
        }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; AmigaSource/1.0; +http://www.amigasource.com/)');
        curl_setopt($ch, CURLOPT_REFERER, 'http://www.amigasource.com/');
        curl_exec($ch);
        $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if (!curl_errno($ch) && $retcode == 200) {
            if ($link['is_dead'] == 1) {
                $sql = "UPDATE links SET is_dead = 0, is_active = 1 WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->bind_param('i', $linkId);
                $stmt->execute();
            }
        } else {
            if ($link['is_dead'] == 0) {
                $sql = "UPDATE links SET is_dead = 1, is_active = 0 WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->bind_param('i', $linkId);
                $stmt->execute();
            }
        }

        $sql = "UPDATE links SET date_verified = NOW() WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $linkId);
        $stmt->execute();
    }

    public function testForDuplicates($url)
    {
        $url = str_replace(['http://', 'https://'], '', $url);
        $url = '%' . $url;

        $sql = "SELECT * FROM links WHERE url LIKE ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('s', $url);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateCategoriesForLink($linkId, $categories)
    {
        $sql = "DELETE FROM links_categories WHERE link_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $linkId);
        $stmt->execute();
        foreach ($categories as $categoryId) {
            $sql = "INSERT INTO links_categories (link_id, category_id) VALUES (?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('ii', $linkId, $categoryId);
            $stmt->execute();
        }
    }

    public function updateLink($linkId, $name, $url, $author, $email, $description, $is_active, $is_dead, $is_recommended, $categories)
    {
        $sql = "UPDATE links SET `name` = ?, `url` = ?, `author` = ?, `email` = ?, `description` = ?, `is_active` = ?, `is_dead` = ?, `is_recommended` = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('sssssiiii', $name, $url, $author, $email, $description, $is_active, $is_dead, $is_recommended, $linkId);
        $stmt->execute();
        $this->updateCategoriesForLink($linkId, $categories);
    }
}
