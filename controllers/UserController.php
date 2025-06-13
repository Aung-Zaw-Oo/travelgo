<?php
require_once '../models/User.php';

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function create($data)
    {

        if (!isset($data['password']) || empty($data['password'])) {
            header("Location: add_user.php?error=Password is required");
            exit();
        }

        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        $created = $this->userModel->createUser($data['name'], $data['email'], $hashedPassword, $data['role']);
        if ($created) {
            header("Location: manage_users.php?success=User created successfully");
        } else {
            header("Location: manage_users.php?error=Failed to create user");
        }
        exit();
    }



    public function index()
    {
        $users = $this->userModel->getAllUsers();
        return $users;
    }


    public function edit($id)
    {
        $user = $this->userModel->getUserById($id);
        if (!$user) {
            die("User not found.");
        }
        return $user;
    }

    public function update($id, $data)
    {
        $name = $data['name'];
        $email = $data['email'];
        $role = $data['role'];


        if (!empty($data['password'])) {
            $password = password_hash($data['password'], PASSWORD_DEFAULT);
            $updated = $this->userModel->updateUserWithPassword($id, $name, $email, $role, $password);
        } else {
            $updated = $this->userModel->updateUser($id, $name, $email, $role);
        }

        if ($updated) {
            header("Location: manage_users.php?success=User updated successfully");
        } else {
            header("Location: manage_users.php?error=Failed to update user");
        }
        exit();
    }


    public function delete($id)
    {
        $deleted = $this->userModel->deleteUser($id);
        if ($deleted) {
            header("Location: manage_users.php?success=User deleted successfully");
        } else {
            header("Location: manage_users.php?error=Failed to delete user");
        }
        exit();
    }
}
