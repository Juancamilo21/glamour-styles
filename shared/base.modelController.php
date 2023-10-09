<?php

    interface BaseModelControllers {

        function findAll();
        function findById();
        function findByEmail();
        function create();
        function update();
        function delete();
    }