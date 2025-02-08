<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Warehouse CMS

## Overview
**Warehouse CMS** is a simple Warehouse Management System built with Laravel 10, MySQL, Vue.js, and Tailwind CSS. The application allows users to manage warehouses and products through full CRUD (Create, Read, Update, Delete) functionality. It also provides a RESTful API for managing products and integrates with the OpenWeather API to display real-time weather data based on each warehouse’s geographical coordinates.

## Features
- **Warehouses:**
  - Create, read, update, and delete warehouses.
  - Attributes: name, description, latitude, and longitude.
  - Real-time weather integration (temperature, weather condition, and wind speed) using the OpenWeather API.
- **Products:**
  - Full CRUD functionality.
  - Each product belongs to a warehouse and has attributes: name, description, price, and quantity.
  - Displays the list of products per warehouse and calculates the total stock value.
- **RESTful API:**
  - Endpoints for managing products (GET, POST, PUT, DELETE).
- **Dashboard (Optional):**
  - Overview of statistics including total warehouses, total products, and aggregate stock value.
  - Displays weather information for each warehouse.
- **Frontend:**
  - User-friendly interface built with Tailwind CSS.
  - Optional Vue.js components for enhanced interactivity.

## Technologies Used
- **Backend:** Laravel 11, PHP 8+
- **Database:** MySQL 8.2
- **Frontend:** Vue.js, Tailwind CSS
- **APIs:** OpenWeather API for weather data
- **Testing:** Laravel’s testing utilities
