<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'email', 'phone', 'password', 'type', 'email_verified', 'created_at', 'updated_at', 'deleted_at'];

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
    protected $beforeInsert   = ['beforeInsert'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['beforeUpdate'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected function beforeInsert(array $data): array
    {
        if (isset($data['data']['password'])) {
            $plaintextPassword = $data['data']['password'];
            $data['data']['password'] = password_hash($plaintextPassword, PASSWORD_BCRYPT);
        }
        return $data;
    }

    protected function beforeUpdate(array $data): array
    {
        if (isset($data['data']['password'])) {
            $plaintextPassword = $data['data']['password'];
            $data['data']['password'] = password_hash($plaintextPassword, PASSWORD_BCRYPT);
        }
        return $data;
    }

    public function withDefault()
    {
        $this->builder()->where('type', DEFAULT_USER_TYPE);
        return $this;
    }

    public function emailVerified($status)
    {
        if ($status === 'yes') {
            $this->builder()->where('email_verified', 1);
        } elseif($status === 'no') {
            $this->builder()->where('email_verified', 0);
        }
        return $this;
    }

    public function deleted($deleted)
    {
        if ($deleted === 'yes') {
            $this->builder()->where('deleted_at !=', '');
        } elseif($deleted === 'no') {
            $this->builder()->where('deleted_at', null);
        }
        return $this;
    }

    public function search($search)
    {
        if ($search) {
            $this->builder()->like('name', $search);
            $this->builder()->orLike('email', $search);
        }
        return $this;
    }

    public function getUserActiveTypes()
    {
        $active_types = array(
            (object) array(
                'name' => 'Both',
                'value' => 'both'
            ),
            (object) array(
                'name' => 'Not Deleted',
                'value' => 'no'
            ),
            (object) array(
                'name' => 'Deleted',
                'value' => 'yes'
            ),
        );

        return $active_types;
    }

    public function getUserStatusTypes()
    {
        $status_types = array(
            (object) array(
                'name' => 'Both',
                'value' => 'both'
            ),
            (object) array(
                'name' => 'Verified',
                'value' => 'yes'
            ),
            (object) array(
                'name' => 'Not Verified',
                'value' => 'no'
            ),
        );

        return $status_types;
    }

    public function getOrderByTypes()
    {
        $order_by_types = array(
            (object) array(
                'name' => 'Registered At',
                'value' => 'created_at'
            ),
            (object) array(
                'name' => 'Name',
                'value' => 'name'
            ),
            (object) array(
                'name' => 'Email',
                'value' => 'email'
            ),
        );

        return $order_by_types;
    }
}
