<?php

    function getModulesArray(){
        $a = [
            '0' => 'Productos',
            '1' => 'Blog'
        ];
        return $a;
    }


    function getRoleUserArrayKey($id){
        $roles = ['0' => 'Usuario normal', '1' => 'Administrador'];
        return $roles[$id];
    }

    function getUserStatusArrayKey($id){
        $status = ['0' => 'Registrado', '1' => 'Verificado', '100' => 'Baneado'];
        return $status[$id];
    }




?>