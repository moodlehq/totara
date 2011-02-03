<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    print 'Connect to database server';

    $link = mssql_connect('192.168.2.26', 'hudson', 'hudson');
    if (!$link) {
        die('Could not connect: ' . mssql_error());
    }

    print 'Drop database hudson';
    mssql_query('DROP DATABASE hudson');

    print 'Create database hudson';
    mssql_query('CREATE DATABASE hudson');
    mssql_query('ALTER DATABASE hudson SET ANSI_NULLS ON');
    mssql_query('ALTER DATABASE hudson SET QUOTED_IDENTIFIER ON');

    mssql_close($link);
