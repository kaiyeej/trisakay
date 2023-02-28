<?php

class Users extends Connection
{
    private $table = 'tbl_users';
    private $pk = 'user_id';
    private $name = 'username';

    public function add()
    {
        $username = $this->clean($this->inputs['username']);
        $is_exist = $this->select($this->table, $this->pk, "username = '$username'");
        if ($is_exist->num_rows > 0) {
            return 2;
        } else {
            $pass = $this->inputs['password'];
            $form = array(
                'user_fname' => $this->inputs['user_fname'],
                'user_mname' => $this->inputs['user_mname'],
                'user_lname' => $this->inputs['user_lname'],
                'category' => $this->inputs['category'],
                'date_added' => $this->getCurrentDate(),
                'username' => $this->inputs['username'],
                'status' => $this->inputs['status'],
                'password' => md5($pass),
                'plate_number'  => $this->inputs['plate_number'],
                'model'  => $this->inputs['model'],
                'manufacturer'  => $this->inputs['manufacturer'],
                'year'  => $this->inputs['year'],
                'color'  => $this->inputs['color'],
            );
            return $this->insert($this->table, $form);
        }
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $user_fname = $this->clean($this->inputs['user_fname']);
        $username = $this->clean($this->inputs['username']);
        $is_exist = $this->select($this->table, $this->pk, "username = '$username' AND  $this->pk != '$primary_id'");
        if ($is_exist->num_rows > 0) {
            return 2;
        } else {
            $form = array(
                'user_fname' => $this->inputs['user_fname'],
                'user_mname' => $this->inputs['user_mname'],
                'user_lname' => $this->inputs['user_lname'],
                'category' => $this->inputs['category'],
                'status' => $this->inputs['status'],
                'username' => $username,
                'plate_number'  => $this->inputs['plate_number'],
                'model'  => $this->inputs['model'],
                'manufacturer'  => $this->inputs['manufacturer'],
                'year'  => $this->inputs['year'],
                'color'  => $this->inputs['color'],
            );
            return $this->update($this->table, $form, "$this->pk = '$primary_id'");
        }
    }

    public function block()
    {
        $ids = implode(",", $this->inputs['ids']);
        $form = array(
            'status' => '1'
        );

        return $this->update($this->table, $form, "$this->pk IN($ids)");
    }

    public function remove()
    {
        $ids = implode(",", $this->inputs['ids']);
        return $this->delete($this->table, "$this->pk IN($ids)");
    }

    public function show()
    {
        $rows = array();
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['driver_id'] = $row['user_id'];
            $row['user_fullname'] = $row['user_fname'] . " " . $row['user_mname'] . " " . $row['user_lname'];
            $row['category'] = $row['category'] == "A" ? '<span class="badge badge-pill badge-info">ADMIN</span>' : ($row['category'] == "U" ? '<span class="badge badge-pill badge-success">USER</span>' : '<span class="badge badge-pill badge-warning">DRIVER</span>');
            $row['user_category'] = $row['category'];
            $rows[] = $row;
        }
        return $rows;
    }

    public function view()
    {
        $primary_id = $this->inputs['id'];
        $result = $this->select($this->table, "*", "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        $row['user_fullname'] = $row['user_fname'] . " " . $row['user_mname'] . " " . $row['user_lname'];
        $row['user_category'] = $row['category'];
        return $row;
    }

    public static function name($primary_id)
    {
        $self = new self;
        $result = $self->select($self->table, $self->name, "$self->pk  = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row[$self->name];
    }

    public static function getUser($primary_id)
    {
        $self = new self;
        $result = $self->select($self->table, "*", "$self->pk  = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row['user_fname'] . " " . $row['user_mname'] . " " . $row['user_lname'];
    }
}
