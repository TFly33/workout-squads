<?php

class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getPosts()
    {
        $this->db->query('SELECT *,
        posts.id as postID,
        users.id as userID,
        posts.created_at as postCreated,
        users.created_at as userCreated 
        FROM posts
        INNER JOIN users
        ON posts.user_id = users.id
        ORDER BY posts.created_at DESC
        ');

        $results = $this->db->resultSet();

        return $results;
    }

    public function addPost($data)
    {
        // Inserting into the database. 
        $this->db->query('INSERT INTO posts (
            pushups, 
            user_id, 
            body, 
            situps, 
            run_miles, 
            bike_miles
            ) 
            VALUES 
            (
            :pushups, 
            :user_id, 
            :body, 
            :situps, 
            :run_miles, 
            :bike_miles
            )
            -- But now I need to address the fact that the user might already have existing submissions. If thats the case, I need the new submission to be ADDED, but not become the new number entirely
            ON DUPLICATE KEY UPDATE 
            -- situps = existing situps + added situps.
            situps = situps + :situps

            -- WHERE user_id = ":user_id"
            ');
        // Bind values
        $this->db->bind(':pushups', $data['pushups']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':situps', $data['situps']);
        $this->db->bind(':run_miles', $data['run_miles']);
        $this->db->bind(':bike_miles', $data['bike_miles']);

        // Execute 
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePost($data)
    {
        // Inserting into the database. 
        $this->db->query('UPDATE posts SET title = :title, body = :body WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);

        // Execute 
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getPostById($id)
    {
        $this->db->query('SELECT * FROM posts WHERE id =:id');
        $this->db->bind(':id', $id);

        // Since it is a single row. 
        $row = $this->db->single();

        return $row;
    }

    public function deletePost($id)
    {
        // Inserting into the database. 
        $this->db->query('DELETE FROM posts WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $id);

        // Execute 
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
