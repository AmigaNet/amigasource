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
        $sql = "SELECT * FROM links WHERE `name` LIKE '%$query%' OR `url` LIKE '%$query%' OR `description` LIKE '%$query%' ORDER BY `name` ASC";
        $result = $this->db->query($sql);
        $links = [];
        while ($row = $result->fetch_assoc()) {
            $links[] = $row;
        }
        return $links;
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
