<?php

namespace App\Models;

use CodeIgniter\Model;

class Post extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'posts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user', 'id_category', 'title', 'sub_title', 'slug', 'post_content', 'header_image', 'created_at', 'updated_at', 'deleted_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    public function withUserAndCategory()
    {
        $this->builder()->select('posts.*, categories.name as category, users.name as user, users.email')
                    ->join('users', 'users.id = posts.id_user')
                    ->join('categories', 'categories.id = posts.id_category');
        return $this;
    }

    public function ownPostsAndCategory($userId)
    {
        $this->builder()->select('posts.*, categories.name as category, users.name as user, users.email')
                    ->join('users', 'users.id = posts.id_user')
                    ->join('categories', 'categories.id = posts.id_category')
                    ->where('users.id', $userId);
        return $this;
    }

    public function withSearch($searchParam)
    {
        $this->builder()->like('posts.id', $searchParam);
        $this->builder()->orLike('users.name', $searchParam);
        $this->builder()->orLike('categories.name', $searchParam);
        $this->builder()->orLike('posts.title', $searchParam);
        $this->builder()->orLike('posts.sub_title', $searchParam);
        $this->builder()->orLike('posts.slug', $searchParam);
        // $this->builder()->orLike('posts.post_content', $searchParam);
        $this->builder()->orLike('posts.created_at', $searchParam);
        $this->builder()->orLike('posts.updated_at', $searchParam);
        return $this;
    }
}
