<?php

    require_once 'BlogService.php';
    $carService = new CarService(require 'config/database.php');
    $car = $carService->getInformationById($_GET['id']);
    require 'login.twig';








