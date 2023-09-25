<?php

namespace AmigaSource\Auth;

class UserEngine
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function fetchAll()
    {
        $sql = "SELECT * FROM users ORDER BY username ASC";
        $result = $this->db->query($sql);
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
    }

    public function fetchByUsername($username)
    {
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $this->db->query($sql);
        $user = $result->fetch_assoc();
        return $user;
    }

    public function isAdmin($username)
    {
        $user = $this->fetchByUsername($username);
        if ($user['role'] == 'admin') {
            return true;
        }

        return false;
    }

    public function login($username, $password)
    {
        $user = $this->fetchByUsername($username);
        if ($user) {
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
        return false;
    }

    public function register($username, $password)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ss', $username, $hash);
        $stmt->execute();

        $user = $this->fetchByUsername($username);
        return $user;
    }
}
