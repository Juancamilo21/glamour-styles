<?php

    interface BaseModel {

        function getAll();
        function getById();
        function create();
        function update();
        function delete();
    }