<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang='ru' xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Last-Modified" content="Thu, 11 Jul 2019 14:45:57 GMT"/>
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="https://m.inavtospb.ru/" rel="alternate" media="only screen and (max-width: 640px)">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=0.75" />
    <?php $this->head() ?>
	<link rel="icon" type="shortcut icon" href="/data/img/favicons/inavtospb.ico?v=2" />
	<link rel="icon" sizes="256x160" href="/data/img/favicons/inavtospb-256x160.png?v=2" type="image/png" />
	<link rel="icon" sizes="192x192" href="/data/img/favicons/inavtospb-192x192.png?v=2" type="image/png" />
	<link rel="icon" sizes="96x96" href="/data/img/favicons/inavtospb-96x96.png?v=2" type="image/png" />
	<link rel="icon" sizes="32x32" href="/data/img/favicons/inavtospb-32x32.png?v=2" type="image/png" />
	<link rel="icon" sizes="16x16" href="/data/img/favicons/inavtospb-16x16.png?v=2" type="image/png" />

	<link type="text/css" rel="Stylesheet" media="screen" href="/css/common.css" />
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:100|Roboto:300,400,500" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="/css/zoomImage.css?14064" media="screen" />

	<script type="text/javascript" src="/js/lib/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="/js/lib/jquery.cookie.js"></script>
	<script type="text/javascript" src="/js/lib/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/js/core3.js"></script>
	<script type="text/javascript" src="/js/zoomImage.js"></script>
        <script src="https://www.google.com/recaptcha/api.js?render=_reCAPTCHA_site_key"></script>
    <script type="text/javascript">
        var PATH = "/";
        var PATH_CONTENT = "/data/";
        var HTTP_PATH = "sp/1";
        var HTTP_ORIGINAL = "/";
        var PATH_STYLES = "/css/";
        var PATH_IMAGES = "/img/";
        var PATH_JS = "/js/";
    </script>
</head>
<body>
     <?php $this->beginBody() ?>
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
	<symbol id="chevron-left-shadow" viewBox="0 0 24 24">
		<path filter="url(#filterShadow)" fill="black" d="M15.41,16.58L10.83,12L15.41,7.41L14,6L8,12L14,18L15.41,16.58Z" />
		<path fill="currentColor" d="M15.41,16.58L10.83,12L15.41,7.41L14,6L8,12L14,18L15.41,16.58Z" />
	</symbol>
	<symbol id="arrow-down" viewBox="0 0 24 24">
		<path fill="currentColor" d="M11,4H13V16L18.5,10.5L19.92,11.92L12,19.84L4.08,11.92L5.5,10.5L11,16V4Z" />
	</symbol>
	<symbol id="chevron-left" viewBox="0 0 24 24">
		<path fill="currentColor" d="M15.41,16.58L10.83,12L15.41,7.41L14,6L8,12L14,18L15.41,16.58Z" />
	</symbol>
	<symbol id="message" viewBox="0 0 24 24">
		<path fill="currentColor" d="M20,2A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H6L2,22V4C2,2.89 2.9,2 4,2H20M4,4V17.17L5.17,16H20V4H4M6,7H18V9H6V7M6,11H15V13H6V11Z" />
	</symbol>
	<symbol id="chevron-right-shadow" viewBox="0 0 24 24">
		<path filter="url(#filterShadow)" fill="black" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
		<path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
	</symbol>
	<symbol id="chevron-right" viewBox="0 0 24 24">
		<path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
	</symbol>
	<symbol id="menu" xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8">
		<path fill="currentColor" d="M0 0v1h8v-1h-8zm0 2.97v1h8v-1h-8zm0 3v1h8v-1h-8z" transform="translate(0 1)" />
	</symbol>
	<symbol id="filter-list" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
		<path d="M10 18h4v-2h-4v2zM3 6v2h18V6H3zm3 7h12v-2H6v2z" fill="currentColor" />
		<path d="M0 0h24v24H0z" fill="none"/>
	</symbol>
	<symbol id="warning" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
		<path d="M0 0h24v24H0z" fill="none"/>
		<path fill="currentColor" d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
	</symbol>
	<symbol id="car2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
		<path fill="currentColor" d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
		<path d="M0 0h24v24H0z" fill="none"/>
	</symbol>
	<symbol id="check-box" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
		<path d="M0 0h24v24H0z" fill="none"/>
		<path fill="currentColor" d="M19 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.11 0 2-.9 2-2V5c0-1.1-.89-2-2-2zm-9 14l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
	</symbol>
	<symbol id="wrench" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
		<path clip-rule="evenodd" d="M0 0h24v24H0z" fill="none"/>
		<path fill="currentColor" d="M22.7 19l-9.1-9.1c.9-2.3.4-5-1.5-6.9-2-2-5-2.4-7.4-1.3L9 6 6 9 1.6 4.7C.4 7.1.9 10.1 2.9 12.1c1.9 1.9 4.6 2.4 6.9 1.5l9.1 9.1c.4.4 1 .4 1.4 0l2.3-2.3c.5-.4.5-1.1.1-1.4z"/>
	</symbol>
	<symbol id="settings" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
		<path d="M0 0h24v24H0z" fill="none"/>
		<path fill="currentColor" d="M19.43 12.98c.04-.32.07-.64.07-.98s-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.3-.61-.22l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65C14.46 2.18 14.25 2 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.23-.09-.49 0-.61.22l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98s.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.12.22.39.3.61.22l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.23.09.49 0 .61-.22l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65zM12 15.5c-1.93 0-3.5-1.57-3.5-3.5s1.57-3.5 3.5-3.5 3.5 1.57 3.5 3.5-1.57 3.5-3.5 3.5z"/>
	</symbol>
	<symbol id="car" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
		<path fill="currentColor" d="M20.938,3.971c-0.258-0.762-0.982-1.305-1.834-1.305H4.896c-0.852,0-1.563,0.542-1.834,1.305l-2.687,7.737v10.333
			c0,0.71,0.581,1.292,1.292,1.292h1.292c0.71,0,1.292-0.581,1.292-1.292V20.75h15.5v1.292c0,0.71,0.581,1.292,1.292,1.292h1.292
			c0.71,0,1.292-0.581,1.292-1.292V11.708L20.938,3.971z M4.896,16.875c-1.072,0-1.937-0.865-1.937-1.937
			C2.958,13.865,3.824,13,4.896,13s1.937,0.865,1.937,1.937C6.833,16.01,5.968,16.875,4.896,16.875z M19.104,16.875
			c-1.072,0-1.937-0.865-1.937-1.937c0-1.072,0.865-1.937,1.937-1.937c1.072,0,1.937,0.865,1.937,1.937
			C21.042,16.01,20.176,16.875,19.104,16.875z M2.958,10.417l1.937-5.812h14.208l1.937,5.812H2.958z"/>
		<path fill="none" d="M0,0h24v24H0V0z"/>
	</symbol>
	<symbol id="info" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
		<path d="M0 0h24v24H0z" fill="none"/>
		<path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
	</symbol>
	<symbol id="info-outline" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
		<path d="M0 0h24v24H0z" fill="none"/>
		<path fill="currentColor" d="M11 17h2v-6h-2v6zm1-15C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zM11 9h2V7h-2v2z"/>
	</symbol>
	<symbol id="key" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
		<path d="M0 0h24v24H0z" fill="none"/>
		<path fill="currentColor" d="M12.65 10C11.83 7.67 9.61 6 7 6c-3.31 0-6 2.69-6 6s2.69 6 6 6c2.61 0 4.83-1.67 5.65-4H17v4h4v-4h2v-4H12.65zM7 14c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/>
	</symbol>
	<symbol id="desktop" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
		<path d="M0 0h24v24H0z" fill="none"/>
		<path fill="currentColor" d="M21 2H3c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h7v2H8v2h8v-2h-2v-2h7c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H3V4h18v12z"/>
	</symbol>
	<symbol id="anchor" viewBox="0 0 484.5 484.5">
		<path fill="currentColor" d="M395.747,222.216l-46.886,81.213h20.733c-0.379,61.102-43.884,112.159-101.553,124.201V221.442h50.766v-52.307h-50.766
	v-25.252c26.99-10.502,46.168-36.764,46.168-67.425c0-39.867-32.437-72.304-72.313-72.304c-39.867,0-72.313,32.437-72.313,72.308
	c0,30.649,19.169,56.9,46.141,67.409v25.264h-50.749v52.307h50.749v206.179c-57.643-12.058-101.132-63.105-101.511-124.192h20.719
	l-46.886-81.213l-46.886,81.213h20.738c0.435,98.887,81.011,179.207,179.999,179.207s179.565-80.32,180.005-179.207h20.733
	L395.747,222.216z M241.896,96.462c-11.029,0-20.001-8.972-20.001-20.001c0-11.029,8.972-20.001,20.001-20.001
	c11.029,0,20.001,8.972,20.001,20.001C261.897,87.491,252.925,96.462,241.896,96.462z"/>
	</symbol>
	<symbol id="download" viewBox="0 0 24 24">
		<path fill="currentColor" d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/>
		<path d="M0 0h24v24H0z" fill="none"/>
	</symbol>
	<symbol id="view-module" viewBox="0 0 24 24">
		<path fill="currentColor" d="M4 11h5V5H4v6zm0 7h5v-6H4v6zm6 0h5v-6h-5v6zm6 0h5v-6h-5v6zm-6-7h5V5h-5v6zm6-6v6h5V5h-5z"/>
		<path d="M0 0h24v24H0z" fill="none"/>
	</symbol>
	<symbol id="like" viewBox="0 0 24 24">
		<path d="M0 0h24v24H0z" fill="none"/>
		<path fill="currentColor" d="M1 21h4V9H1v12zm22-11c0-1.1-.9-2-2-2h-6.31l.95-4.57.03-.32c0-.41-.17-.79-.44-1.06L14.17 1 7.59 7.59C7.22 7.95 7 8.45 7 9v10c0 1.1.9 2 2 2h9c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73v-1.91l-.01-.01L23 10z"/>
	</symbol>
	<symbol id="star-round" viewBox="0 0 24 24">
		<path d="M0 0h24v24H0z" fill="none"/>
		<path fill="currentColor" d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zm4.24 16L12 15.45 7.77 18l1.12-4.81-3.73-3.23 4.92-.42L12 5l1.92 4.53 4.92.42-3.73 3.23L16.23 18z"/>
	</symbol>
	<symbol id="monument" viewBox="0 0 24 24">
		<path d="M0 0h24v24H0z" fill="none"/>
		<path fill="currentColor" d="M4 10v7h3v-7H4zm6 0v7h3v-7h-3zM2 22h19v-3H2v3zm14-12v7h3v-7h-3zm-4.5-9L2 6v2h19V6l-9.5-5z"/>
	</symbol>
	<symbol id="wallet" viewBox="0 0 24 24">
		<path d="M0 0h24v24H0z" fill="none"/>
		<path fill="currentColor" d="M21 18v1c0 1.1-.9 2-2 2H5c-1.11 0-2-.9-2-2V5c0-1.1.89-2 2-2h14c1.1 0 2 .9 2 2v1h-9c-1.11 0-2 .9-2 2v8c0 1.1.89 2 2 2h9zm-9-2h10V8H12v8zm4-2.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/>
	</symbol>
	<symbol id="rss" viewBox="0 0 24 24">
		<path d="M0 0h24v24H0z" fill="none"/>
		<circle fill="currentColor" cx="6.18" cy="17.82" r="2.18"/>
		<path fill="currentColor" d="M4 4.44v2.83c7.03 0 12.73 5.7 12.73 12.73h2.83c0-8.59-6.97-15.56-15.56-15.56zm0 5.66v2.83c3.9 0 7.07 3.17 7.07 7.07h2.83c0-5.47-4.43-9.9-9.9-9.9z"/>
	</symbol>
	<symbol id="iphone" viewBox="0 0 24 24">
		<path fill="currentColor" d="M15.5 1h-8C6.12 1 5 2.12 5 3.5v17C5 21.88 6.12 23 7.5 23h8c1.38 0 2.5-1.12 2.5-2.5v-17C18 2.12 16.88 1 15.5 1zm-4 21c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm4.5-4H7V4h9v14z"/>
		<path d="M0 0h24v24H0z" fill="none"/>
	</symbol>
	<symbol id="guide" viewBox="0 0 24 24">
		<path fill="currentColor" d="M12 14c1.66 0 2.99-1.34 2.99-3L15 5c0-1.66-1.34-3-3-3S9 3.34 9 5v6c0 1.66 1.34 3 3 3zm5.3-3c0 3-2.54 5.1-5.3 5.1S6.7 14 6.7 11H5c0 3.41 2.72 6.23 6 6.72V21h2v-3.28c3.28-.48 6-3.3 6-6.72h-1.7z"/>
		<path d="M0 0h24v24H0z" fill="none"/>
	</symbol>
	<symbol id="restaurant-menu" viewBox="0 0 24 24">
		<path d="M0 0h24v24H0z" fill="none"/>
		<path fill="currentColor" d="M8.1 13.34l2.83-2.83L3.91 3.5c-1.56 1.56-1.56 4.09 0 5.66l4.19 4.18zm6.78-1.81c1.53.71 3.68.21 5.27-1.38 1.91-1.91 2.28-4.65.81-6.12-1.46-1.46-4.2-1.1-6.12.81-1.59 1.59-2.09 3.74-1.38 5.27L3.7 19.87l1.41 1.41L12 14.41l6.88 6.88 1.41-1.41L13.41 13l1.47-1.47z"/>
	</symbol>
	<symbol id="reception" viewBox="0 0 24 24">
		<path d="M0 0h24v24H0V0z" fill="none"/>
		<path fill="currentColor" d="M20 3H4v10c0 2.21 1.79 4 4 4h6c2.21 0 4-1.79 4-4v-3h2c1.11 0 2-.9 2-2V5c0-1.11-.89-2-2-2zm0 5h-2V5h2v3zM4 19h16v2H4z"/>
	</symbol>
	<symbol id="banquet" viewBox="0 0 24 24">
		<path fill="currentColor" d="M11 9H9V2H7v7H5V2H3v7c0 2.12 1.66 3.84 3.75 3.97V22h2.5v-9.03C11.34 12.84 13 11.12 13 9V2h-2v7zm5-3v8h2.5v8H21V2c-2.76 0-5 2.24-5 4z"/>
		<path d="M0 0h24v24H0z" fill="none"/>
	</symbol>
	<symbol id="excursion" viewBox="0 0 24 24">
		<path fill="currentColor" d="M20.5 3l-.16.03L15 5.1 9 3 3.36 4.9c-.21.07-.36.25-.36.48V20.5c0 .28.22.5.5.5l.16-.03L9 18.9l6 2.1 5.64-1.9c.21-.07.36-.25.36-.48V3.5c0-.28-.22-.5-.5-.5zM15 19l-6-2.11V5l6 2.11V19z"/>
		<path d="M0 0h24v24H0z" fill="none"/>
	</symbol>
	<svg id="map" viewBox="0 0 24 24">
		<path fill="currentColor" d="M20.5 3l-.16.03L15 5.1 9 3 3.36 4.9c-.21.07-.36.25-.36.48V20.5c0 .28.22.5.5.5l.16-.03L9 18.9l6 2.1 5.64-1.9c.21-.07.36-.25.36-.48V3.5c0-.28-.22-.5-.5-.5zM15 19l-6-2.11V5l6 2.11V19z"/>
		<path d="M0 0h24v24H0z" fill="none"/>
	</svg>
	<symbol id="coctail" viewBox="0 0 24 24">
		<path fill="currentColor" d="M21 5V3H3v2l8 9v5H6v2h12v-2h-5v-5l8-9zM7.43 7L5.66 5h12.69l-1.78 2H7.43z"/>
		<path d="M0 0h24v24H0z" fill="none"/>
	</symbol>

	<symbol id="view-list" viewBox="0 0 24 24">
		<path fill="currentColor" d="M4 14h4v-4H4v4zm0 5h4v-4H4v4zM4 9h4V5H4v4zm5 5h12v-4H9v4zm0 5h12v-4H9v4zM9 5v4h12V5H9z"/>
		<path d="M0 0h24v24H0z" fill="none"/>
	</symbol>
	<symbol id="zoom" viewBox="0 0 24 24">
		<path fill="currentColor" d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
		<path d="M0 0h24v24H0V0z" fill="none"/>
		<path fill="currentColor" d="M12 10h-2v2H9v-2H7V9h2V7h1v2h2v1z"/>
	</symbol>
	<symbol id="photo-camera" viewBox="0 0 24 24">
		<circle fill="currentColor" cx="12" cy="12" r="3.2"/>
		<path fill="currentColor" d="M9 2L7.17 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2h-3.17L15 2H9zm3 15c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5z"/>
		<path d="M0 0h24v24H0z" fill="none"/>
	</symbol>
	<symbol id="men1" viewBox="0 0 510 510">
		<path fill="currentColor" d="M255,0c28.05,0,51,22.95,51,51s-22.95,51-51,51s-51-22.95-51-51S226.95,0,255,0z M484.5,178.5h-153V510h-51V357h-51v153
			h-51V178.5h-153v-51h459V178.5z"/>
	</symbol>
	<symbol id="attachment" viewBox="0 0 510 510">
		<path fill="currentColor" d="M140.25,395.25C63.75,395.25,0,331.5,0,255s63.75-140.25,140.25-140.25H408c56.1,0,102,45.9,102,102
			c0,56.1-45.9,102-102,102H191.25c-35.7,0-63.75-28.05-63.75-63.75s28.05-63.75,63.75-63.75H382.5v38.25H191.25
			c-15.3,0-25.5,10.2-25.5,25.5s10.2,25.5,25.5,25.5H408c35.7,0,63.75-28.05,63.75-63.75S443.7,153,408,153H140.25
			c-56.1,0-102,45.9-102,102c0,56.1,45.9,102,102,102H382.5v38.25H140.25z"/>
	</symbol>
	<symbol id="bookmark-outline" viewBox="0 0 459 459">
		<path fill="currentColor" d="M357,0H102C73.95,0,51,22.95,51,51v408l178.5-76.5L408,459V51C408,22.95,385.05,0,357,0z M357,382.5l-127.5-56.1
			L102,382.5V51h255V382.5z"/>
	</symbol>
	<symbol id="plus-box" viewBox="0 0 24 24">
		<path fill="currentColor" d="M19 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/>
		<path d="M0 0h24v24H0z" fill="none"/>
	</symbol>
	<symbol id="minus-box" viewBox="0 0 24 24">
		<defs>
			<path fill="currentColor" d="M0 0h24v24H0z" id="a"/>
		</defs>
		<clipPath id="b">
			<use overflow="visible" xlink:href="#a"/>
		</clipPath>
		<path clip-path="url(#b)" d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10H7v-2h10v2z"/>
	</symbol>
	<symbol id="cancel-button" viewBox="0 0 510 510">
		<path fill="currentColor" d="M255,0C114.75,0,0,114.75,0,255s114.75,255,255,255s255-114.75,255-255S395.25,0,255,0z M382.5,346.8l-35.7,35.7
			L255,290.7l-91.8,91.8l-35.7-35.7l91.8-91.8l-91.8-91.8l35.7-35.7l91.8,91.8l91.8-91.8l35.7,35.7L290.7,255L382.5,346.8z"/>
	</symbol>
	<symbol id="clear-shadow" viewBox="0 0 24 24">
		<path filter="url(#filterShadow)" fill="#000000" d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z" />
		<path fill="currentColor" d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z" />
	</symbol>
	<symbol id="clear" viewBox="0 0 24 24">
		<path fill="currentColor" d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z" />
	</symbol>
	<symbol id="download" viewBox="0 0 433.5 433.5">
		<path fill="currentColor" d="M395.25,153h-102V0h-153v153h-102l178.5,178.5L395.25,153z M38.25,382.5v51h357v-51H38.25z"/>
	</symbol>
	<symbol id="favorite" viewBox="0 0 510 510">
		<path fill="currentColor" d="M255,489.6l-35.7-35.7C86.7,336.6,0,257.55,0,160.65C0,81.6,61.2,20.4,140.25,20.4c43.35,0,86.7,20.4,114.75,53.55
			C283.05,40.8,326.4,20.4,369.75,20.4C448.8,20.4,510,81.6,510,160.65c0,96.9-86.7,175.95-219.3,293.25L255,489.6z"/>
	</symbol>
	<symbol id="placeholder" viewBox="0 0 510 510">
		<path fill="currentColor" d="M255,0C155.55,0,76.5,79.05,76.5,178.5C76.5,311.1,255,510,255,510s178.5-198.9,178.5-331.5C433.5,79.05,354.45,0,255,0z
			 M255,242.25c-35.7,0-63.75-28.05-63.75-63.75s28.05-63.75,63.75-63.75s63.75,28.05,63.75,63.75S290.7,242.25,255,242.25z"/>
	</symbol>
	<symbol id="mobile-phone" viewBox="0 0 561 561">
		<path fill="currentColor" d="M408,0H153c-28.05,0-51,22.95-51,51v459c0,28.05,22.95,51,51,51h255c28.05,0,51-22.95,51-51V51C459,22.95,436.05,0,408,0z
			 M408,459H153V102h255V459z"/>
	</symbol>
	<symbol id="callback" viewBox="0 0 510 510">
		<path fill="currentColor" d="M382.5,255L510,127.5L382.5,0v76.5h-102v102h102V255z M433.5,369.75c-30.6,0-61.2-5.1-91.8-15.3
				c-7.65-2.55-17.851,0-25.5,5.1L260.1,415.65c-71.399-35.7-130.05-96.9-168.3-168.3l56.1-56.1c7.65-7.65,10.2-17.85,5.1-25.5
				c-7.65-28.05-12.75-58.65-12.75-89.25c0-15.3-10.2-25.5-25.5-25.5H25.5C10.2,51,0,61.2,0,76.5C0,316.2,193.8,510,433.5,510
				c15.3,0,25.5-10.2,25.5-25.5v-89.25C459,379.95,448.8,369.75,433.5,369.75z"/>
	</symbol>

	<symbol id="envelope" viewBox="0 0 510 510">
		<path fill="currentColor" d="M459,51H51C22.95,51,0,73.95,0,102v306c0,28.05,22.95,51,51,51h408c28.05,0,51-22.95,51-51V102
			C510,73.95,487.05,51,459,51z M459,153L255,280.5L51,153v-51l204,127.5L459,102V153z"/>
	</symbol>
	<symbol id="favorite-outline" viewBox="0 0 510 510">
		<path fill="currentColor" d="M369.75,21.675c-43.35,0-86.7,20.4-114.75,53.55c-28.05-33.15-71.4-53.55-114.75-53.55C61.2,21.675,0,82.875,0,161.925
			c0,96.9,86.7,175.95,219.3,293.25l35.7,33.15l35.7-33.15c130.05-119.85,219.3-198.9,219.3-293.25
			C510,82.875,448.8,21.675,369.75,21.675z M257.55,419.475H255l-2.55-2.55C130.05,307.274,51,235.875,51,161.925
			c0-51,38.25-89.25,89.25-89.25c38.25,0,76.5,25.5,91.8,61.2h48.45c12.75-35.7,51-61.2,89.25-61.2c51,0,89.25,38.25,89.25,89.25
			C459,235.875,379.95,307.274,257.55,419.475z"/>
	</symbol>
	<symbol id="menu" viewBox="0 0 459 459">
		<path fill="currentColor" d="M0,382.5h459v-51H0V382.5z M0,255h459v-51H0V255z M0,76.5v51h459v-51H0z"/>
	</symbol>
	<symbol id="phone-call" viewBox="0 0 459 459">
		<path fill="currentColor" d="M0,382.5h459v-51H0V382.5z M0,255h459v-51H0V255z M0,76.5v51h459v-51H0z"/>
	</symbol>
	<symbol id="info-round" viewBox="0 0 510 510">
		<path fill="currentColor" d="M229.5,382.5h51v-153h-51V382.5z M255,0C114.75,0,0,114.75,0,255s114.75,255,255,255s255-114.75,255-255S395.25,0,255,0z
			 M255,459c-112.2,0-204-91.8-204-204S142.8,51,255,51s204,91.8,204,204S367.2,459,255,459z M229.5,178.5h51v-51h-51V178.5z"/>
	</symbol>
	<symbol id="info" viewBox="0 0 510 510">
		<path fill="currentColor" d="M255,0C114.75,0,0,114.75,0,255s114.75,255,255,255s255-114.75,255-255S395.25,0,255,0z M280.5,382.5h-51v-153h51V382.5z
			 M280.5,178.5h-51v-51h51V178.5z"/>
	</symbol>
	<symbol id="peoples" viewBox="0 0 561 561">
		<path fill="currentColor" d="M382.5,255c43.35,0,76.5-33.15,76.5-76.5S425.85,102,382.5,102S306,135.15,306,178.5S339.15,255,382.5,255z M178.5,255
			c43.35,0,76.5-33.15,76.5-76.5S221.85,102,178.5,102S102,135.15,102,178.5S135.15,255,178.5,255z M178.5,306
			C119.85,306,0,336.6,0,395.25V459h357v-63.75C357,336.6,237.15,306,178.5,306z M382.5,306c-7.65,0-15.3,0-25.5,2.55
			c30.6,20.4,51,51,51,86.7V459h153v-63.75C561,336.6,441.15,306,382.5,306z"/>
	</symbol>
	<symbol id="user" viewBox="0 0 408 408">
		<path fill="currentColor" d="M204,204c56.1,0,102-45.9,102-102S260.1,0,204,0c-56.1,0-102,45.9-102,102S147.9,204,204,204z M204,255
			C135.15,255,0,288.15,0,357v51h408v-51C408,288.15,272.85,255,204,255z"/>
	</symbol>
	<symbol id="list" viewBox="0 0 459 459">
		<path fill="currentColor" d="M0,255h51v-51H0V255z M0,357h51v-51H0V357z M0,153h51v-51H0V153z M102,255h357v-51H102V255z M102,357h357v-51H102V357z
			 M102,102v51h357v-51H102z"/>
	</symbol>
	<symbol id="search" viewBox="0 0 446.25 446.25">
		<path fill="currentColor" d="M318.75,280.5h-20.4l-7.649-7.65c25.5-28.05,40.8-66.3,40.8-107.1C331.5,73.95,257.55,0,165.75,0S0,73.95,0,165.75
			S73.95,331.5,165.75,331.5c40.8,0,79.05-15.3,107.1-40.8l7.65,7.649v20.4L408,446.25L446.25,408L318.75,280.5z M165.75,280.5
			C102,280.5,51,229.5,51,165.75S102,51,165.75,51S280.5,102,280.5,165.75S229.5,280.5,165.75,280.5z"/>
	</symbol>
	<symbol id="keyboard-enter" viewBox="0 0 484.5 484.5">
		<polygon fill="currentColor" points="433.5,114.75 433.5,216.75 96.9,216.75 188.7,124.95 153,89.25 0,242.25 153,395.25 188.7,359.55 96.9,267.75
			484.5,267.75 484.5,114.75"/>
	</symbol>
	<symbol id="timer" viewBox="0 0 24 24">
		<path d="M0 0h24v24H0z" fill="none"/>
		<path fill="currentColor" d="M11 17c0 .55.45 1 1 1s1-.45 1-1-.45-1-1-1-1 .45-1 1zm0-14v4h2V5.08c3.39.49 6 3.39 6 6.92 0 3.87-3.13 7-7 7s-7-3.13-7-7c0-1.68.59-3.22 1.58-4.42L12 13l1.41-1.41-6.8-6.8v.02C4.42 6.45 3 9.05 3 12c0 4.97 4.02 9 9 9 4.97 0 9-4.03 9-9s-4.03-9-9-9h-1zm7 9c0-.55-.45-1-1-1s-1 .45-1 1 .45 1 1 1 1-.45 1-1zM6 12c0 .55.45 1 1 1s1-.45 1-1-.45-1-1-1-1 .45-1 1z"/>
	</symbol>
	<symbol id="keyboard-right" viewBox="0 0 306 306">
		<polygon points="94.35,0 58.65,35.7 175.95,153 58.65,270.3 94.35,306 247.35,153"/>
	</symbol>
	<symbol id="keyboard-down" viewBox="0 0 24 24">
		<path fill="currentColor" d="M7.41 7.84L12 12.42l4.59-4.58L18 9.25l-6 6-6-6z"/>
		<path d="M0-.75h24v24H0z" fill="none"/>
	</symbol>
	<symbol id="keyboard-up" viewBox="0 0 24 24">
		<path fill="currentColor" d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/>
		<path d="M0 0h24v24H0z" fill="none"/>
	</symbol>
	<symbol id="bell" viewBox="0 0 510 510">
		<path fill="currentColor" d="M255,510c28.05,0,51-22.95,51-51H204C204,487.05,226.95,510,255,510z M420.75,357V216.75
			c0-79.05-53.55-142.8-127.5-160.65V38.25C293.25,17.85,275.4,0,255,0c-20.4,0-38.25,17.85-38.25,38.25V56.1
			c-73.95,17.85-127.5,81.6-127.5,160.65V357l-51,51v25.5h433.5V408L420.75,357z M369.75,382.5h-229.5V216.75
			C140.25,153,191.25,102,255,102s114.75,51,114.75,114.75V382.5z"/>
	</symbol>
	<symbol id="compare" viewBox="0 0 947.3 947.3">
		<path fill="currentColor" d="M515.1,649.9c0,57.701,22.5,112,63.3,152.801C619.2,843.5,673.5,866,731.2,866c57.699,0,112-22.5,152.8-63.299
			c40.899-40.801,63.3-95,63.3-152.801c0-34.9-8.5-69.5-24.6-100.199L775.399,247.2h24.7c13.8,0,25-11.2,25-25v-41.7
			c0-13.8-11.2-25-25-25H612c-4.601-41.4-66.3-74.2-141.8-74.2s-137.2,32.8-141.801,74.2H140.3c-13.8,0-25,11.2-25,25v41.7
			c0,13.8,11.2,25,25,25h31.6l-147.3,302.5C8.5,580.4,0,615.101,0,649.9c0,57.701,22.5,112,63.3,152.801
			C104.1,843.5,158.4,866,216.1,866c57.7,0,112-22.5,152.8-63.299c40.9-40.801,63.4-95,63.4-152.801c0-34.9-8.5-69.5-24.6-100.199
			L260.3,247.2h426.8L539.7,549.701C523.6,580.4,515.1,615.101,515.1,649.9z M353.899,576.4l0.4,0.9c11.9,22.6,17.9,47,17.9,72.699
			H60c0-25.699,6-50.1,17.9-72.699l0.2-0.4l138-283.2L353.899,576.4z M593,577.3l0.2-0.4l138-283.2L869,576.5l0.399,0.9
			c11.9,22.6,17.9,47,17.9,72.701H575.1C575.1,624.3,581.1,599.8,593,577.3z"/>
	</symbol>
	<symbol id="flag" viewBox="0 0 433.5 433.5">
		<polygon points="265.2,51 255,0 25.5,0 25.5,433.5 76.5,433.5 76.5,255 219.3,255 229.5,306 408,306 408,51"/>
	</symbol>
	<symbol id="logout" viewBox="0 0 459 459">
		<path fill="currentColor" d="M181.05,321.3l35.7,35.7l127.5-127.5L216.75,102l-35.7,35.7l66.3,66.3H0v51h247.35L181.05,321.3z M408,0H51
			C22.95,0,0,22.95,0,51v102h51V51h357v357H51V306H0v102c0,28.05,22.95,51,51,51h357c28.05,0,51-22.95,51-51V51
			C459,22.95,436.05,0,408,0z"/>
	</symbol>

	<symbol id="facebook" viewBox="0 0 94 94" xmlns="http://www.w3.org/2000/svg">
		<path fill="currentColor" d="M89,0H5C2.239,0,0,2.239,0,5v84c0,2.761,2.239,5,5,5h84c2.762,0,5-2.239,5-5V5C94,2.239,91.762,0,89,0z M66.93,21.364
			l-7.226,0.003c-5.664,0-6.761,2.692-6.761,6.643v8.711h13.511L66.45,50.365H52.943v35.012H38.852V50.365H27.07V36.721h11.782
			V26.659c0-11.677,7.133-18.036,17.548-18.036L66.93,8.64V21.364z"/>
	</symbol>

	<symbol id="youtube" viewBox="0 0 94 94" xmlns="http://www.w3.org/2000/svg">
		<path fill="currentColor" d="M89,0H5C2.238,0,0,2.239,0,5v84c0,2.761,2.238,5,5,5h84c2.762,0,5-2.239,5-5V5C94,2.239,91.762,0,89,0z M84.436,65.34
			c-0.951,4.126-4.326,7.169-8.385,7.624c-9.621,1.075-19.357,1.082-29.055,1.075c-9.695,0.006-19.434,0-29.055-1.075
			c-4.061-0.454-7.436-3.498-8.385-7.624c-1.35-5.876-1.35-12.29-1.35-18.339c0-6.05,0.016-12.464,1.367-18.341
			c0.949-4.126,4.32-7.169,8.383-7.624c9.621-1.074,19.359-1.079,29.056-1.074c9.692-0.005,19.432,0,29.053,1.074
			c4.062,0.455,7.438,3.498,8.387,7.624c1.354,5.876,1.342,12.291,1.342,18.341C85.793,53.05,85.787,59.463,84.436,65.34z"/>
		<path fill="currentColor" d="M36.988,59.042c8.242-4.274,16.417-8.512,24.667-12.789c-8.275-4.318-16.443-8.579-24.667-12.87
			C36.988,41.967,36.988,50.461,36.988,59.042z"/>
	</symbol>

	<symbol id="instagram" viewBox="0 0 94 94" xmlns="http://www.w3.org/2000/svg">
		<path fill="currentColor" d="M64.748,32.155h8.781c1.923,0,3.496-1.574,3.496-3.498v-8.371c0-1.925-1.573-3.498-3.496-3.498h-8.781
			c-1.924,0-3.497,1.573-3.497,3.498v8.371C61.251,30.581,62.824,32.155,64.748,32.155z"/>
		<ellipse fill="currentColor" cx="47.074" cy="46.831" rx="15.602" ry="15.117"/>
		<path fill="currentColor" d="M89,0H5C2.239,0,0,2.239,0,5v84c0,2.761,2.239,5,5,5h84c2.762,0,5-2.239,5-5V5C94,2.239,91.762,0,89,0z M85.843,75.872
			c0,5.911-4.487,9.971-9.971,9.971H18.128c-5.484,0-9.971-4.06-9.971-9.971V18.128c0-5.911,4.486-9.971,9.971-9.971h57.744
			c5.483,0,9.971,4.06,9.971,9.971V75.872z"/>
		<path fill="currentColor" d="M71.221,47.676c0,12.922-10.812,23.396-24.146,23.396c-13.336,0-24.147-10.475-24.147-23.396
			c0-2.316,0.35-4.553,0.997-6.666h-7.136v32.815c0,1.698,1.391,3.088,3.089,3.088h54.099c1.697,0,3.088-1.39,3.088-3.088V41.01
			h-6.838C70.871,43.123,71.221,45.359,71.221,47.676z"/>
	</symbol>

	<symbol id="twitter" viewBox="0 0 94 94" xmlns="http://www.w3.org/2000/svg">
		<path fill="currentColor" d="M89,0H5C2.239,0,0,2.239,0,5v84c0,2.761,2.239,5,5,5h84c2.762,0,5-2.239,5-5V5C94,2.239,91.762,0,89,0z M85.874,23.302
			c-2.122,3.177-4.752,5.922-7.817,8.164c0.024,0.616,0.036,1.233,0.036,1.855c0,22.315-16.979,45.396-45.396,45.396
			c-8.687,0-17.144-2.479-24.458-7.169c-0.152-0.097-0.217-0.286-0.155-0.456c0.061-0.169,0.234-0.273,0.409-0.254
			c1.229,0.146,2.482,0.219,3.729,0.219c6.758,0,13.156-2.089,18.567-6.053c-6.487-0.547-12.062-4.938-14.068-11.199
			c-0.041-0.131-0.011-0.271,0.08-0.375c0.09-0.103,0.229-0.146,0.362-0.123c1.797,0.342,3.624,0.362,5.387,0.078
			c-6.69-2.08-11.393-8.346-11.393-15.481l0.002-0.208c0.003-0.136,0.077-0.26,0.193-0.326c0.118-0.068,0.264-0.069,0.381-0.003
			c1.743,0.968,3.677,1.591,5.655,1.828c-3.844-3.064-6.102-7.709-6.102-12.678c0-2.867,0.76-5.686,2.194-8.148
			c0.064-0.109,0.178-0.182,0.305-0.19c0.127-0.013,0.25,0.042,0.329,0.142c7.87,9.651,19.444,15.595,31.821,16.358
			c-0.208-1.04-0.312-2.11-0.312-3.191c0-8.936,7.271-16.205,16.206-16.205c4.396,0,8.639,1.806,11.681,4.96
			c3.432-0.699,6.697-1.96,9.715-3.75c0.139-0.082,0.312-0.069,0.438,0.03c0.125,0.101,0.176,0.268,0.126,0.421
			c-1.021,3.199-3.018,5.989-5.696,8.004c2.523-0.439,4.974-1.182,7.302-2.214c0.157-0.072,0.342-0.027,0.453,0.104
			C85.959,22.97,85.971,23.158,85.874,23.302z"/>
	</symbol>

	<symbol id="vk" viewBox="0 0 94 94" xmlns="http://www.w3.org/2000/svg">
		<path fill="currentColor" d="M89,0H5C2.238,0,0,2.239,0,5v84c0,2.761,2.238,5,5,5h84c2.762,0,5-2.239,5-5V5C94,2.239,91.762,0,89,0z M74.869,52.943
			c2.562,2.5,5.271,4.854,7.572,7.617c1.018,1.22,1.978,2.48,2.709,3.899c1.041,2.024,0.101,4.247-1.713,4.366l-11.256-0.003
			c-2.906,0.239-5.22-0.931-7.172-2.918c-1.555-1.585-3.001-3.277-4.5-4.914c-0.611-0.673-1.259-1.306-2.025-1.806
			c-1.534-0.996-2.867-0.692-3.748,0.909c-0.896,1.63-1.103,3.438-1.185,5.255c-0.125,2.655-0.925,3.348-3.588,3.471
			c-5.69,0.268-11.091-0.596-16.108-3.463c-4.429-2.53-7.854-6.104-10.838-10.146c-5.816-7.883-10.27-16.536-14.27-25.437
			c-0.901-2.005-0.242-3.078,1.967-3.119c3.676-0.073,7.351-0.063,11.022-0.004c1.496,0.023,2.485,0.879,3.058,2.289
			c1.985,4.885,4.421,9.533,7.471,13.843c0.813,1.147,1.643,2.292,2.823,3.103c1.304,0.896,2.298,0.601,2.913-0.854
			c0.393-0.928,0.563-1.914,0.647-2.906c0.292-3.396,0.327-6.792-0.177-10.175c-0.315-2.116-1.507-3.483-3.617-3.883
			c-1.074-0.204-0.917-0.602-0.395-1.215c0.906-1.062,1.76-1.718,3.456-1.718l12.721-0.002c2.006,0.392,2.452,1.292,2.725,3.311
			l0.012,14.133c-0.021,0.782,0.391,3.098,1.795,3.61c1.123,0.371,1.868-0.53,2.54-1.244c3.048-3.235,5.22-7.056,7.167-11.009
			c0.857-1.743,1.6-3.549,2.32-5.356c0.533-1.337,1.367-1.995,2.875-1.971l12.246,0.013c0.36,0,0.729,0.004,1.086,0.063
			c2.062,0.355,2.627,1.243,1.99,3.257c-1.004,3.163-2.959,5.799-4.871,8.441c-2.043,2.825-4.224,5.557-6.252,8.396
			C72.411,49.38,72.561,50.688,74.869,52.943z"/>
	</symbol>
</svg>
<div class="wrapper">
	<header>
	<div class="row">
		<div class="logo span3">
			<a href="/" class="row inavto" title="ИНАВТО+ - сервис и ремонт Volvo c 1992 года">
				<img src="/img/inavto-144.png" class="inavtospb-logo" alt="ИНАВТО+" />
				<div>
					<strong>ИНАВТО+</strong>
					<em>ремонт volvo в спб с 1992 года</em>
				</div>
			</a>
		</div>
		<?php
                    if ($this->beginCache('ContactsWidget', ['duration' => 60])) {
                    echo \frontend\widgets\ContactsWidget::widget(['tpl' => 'index']);
                    $this->endCache(); }
                ?>

		<div class="buttons span2">
			<button class="btn parts"><svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#settings"></use></svg>Заказ запчастей</button>
                        <?= frontend\widgets\FormWidget::widget(['tpl' => 'index', 'flag' => 1]);?>
			<a href="/#calc" class="btn calc"><svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#car"></use></svg>Калькулятор ТО</a>
			<button class="btn green repairButton"><svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#wrench"></use></svg>Запись на сервис</button>
                        <?= frontend\widgets\FormWidget::widget(['tpl' => 'service', 'flag' => 2]);?>
		</div>
	</div>
</header>
<?= \frontend\widgets\MenuWidget::widget(['tpl' => 'index', 'cache_time' => 60])?>
<script type="text/javascript">
	$(document).ready(function(){

		// callback form
		$('.callback').click(function(){
			$('.modal.callback').toggleClass('show',true);
			$('.backdrop').toggleClass('show',true);
		});
	});
</script>
	<a name="calc"></a>
<?=$content; ?>
</div>
<footer>
	<div class="in">
		<div class="row">
			<div class="left span9">
				<nav class="footerMenu">
					<ol>
						<li><a href="/inavto">Наш сервис</a></li>
						<li><a href="/zapchasti">Запасные части</a></li>
						<li><a href="/diagnostika-volvo">Диагностика Volvo</a></li>
						<li><a href="/protochka-tormoznih-diskov">Проточка тормозных дисков</a></li>
						<li><a href="/vtoraya-pedal">Установка дублирующих педалей</a></li>
						<li><a href="/diesel-bosch">Дизельная аппаратура Bosch</a></li>
						<li><a href="/diesel-delphi">Дизельная аппаратура Delphi</a></li>
					</ol>
					<ul>
						<li><a href="/remont"><strong>Ремонт Volvo</strong></a></li>
						<li><a href="/remont/volvo-xc90">Ремонт Volvo XC90</a></li>
						<li><a href="/remont/volvo-xc70">Ремонт Volvo XC70</a></li>
						<li><a href="/remont/volvo-xc60">Ремонт Volvo XC60</a></li>
						<li><a href="/remont/volvo-s80">Ремонт Volvo S80</a></li>
						<li><a href="/remont/volvo-s60">Ремонт Volvo S60</a></li>
						<li><a href="/remont/volvo-s40-v40">Ремонт Volvo V40 и V40 CC</a></li>
						<li><a href="/remont/volvo-v50">Ремонт Volvo S40 и V50</a></li>
						<li><a href="/remont/volvo-c30">Ремонт Volvo C30</a></li>
					</ul>
					<ul>
						<li><a href="/obsluzhivanie"><strong>Обслуживание Volvo</strong></a></li>
						<li><a href="/obsluzhivanie/volvo-xc90">Обслуживание Volvo XC90</a></li>
						<li><a href="/obsluzhivanie/volvo-xc70">Обслуживание Volvo XC70</a></li>
						<li><a href="/obsluzhivanie/volvo-xc60">Обслуживание Volvo XC60</a></li>
						<li><a href="/obsluzhivanie/volvo-s80">Обслуживание Volvo S80</a></li>
						<li><a href="/obsluzhivanie/volvo-s60">Обслуживание Volvo S60</a></li>
						<li><a href="/obsluzhivanie/volvo-s40-v40">Обслуживание Volvo V40 и V40 CC</a></li>
						<li><a href="/obsluzhivanie/volvo-v50">Обслуживание Volvo S40 и V50</a></li>
						<li><a href="/obsluzhivanie/volvo-c30">Обслуживание Volvo C30</a></li>
					</ul>
				</nav>
			</div>
			<div class="right span3">
				<div>
					<a href="/contacts" class="service">
						Автосервис на <span class="vector">юге</span> СПб:<br />
						ул. Салова д. 68
						<svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#placeholder"></use></svg>
					</a>
					<a href="/contacts" class="service">
						Автосервис на <span class="vector">севере</span> СПб:<br />
						Екатерининский пр. 5А
						<svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#placeholder"></use></svg>
					</a>
				</div>
				<div class="social">
					<a href="https://vk.com/inavtospbru"><svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#vk"></use></svg></a>
					<!--<a href="http://facebook.com/inavtospb"><svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#facebook"></use></svg></a>-->
				</div>
                            <noindex><a rel="nofollow" href="<?= \yii\helpers\Url::to(['site/version', 'version' => 'mobile']); ?>" class="btn mobile"><svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#iphone"></use></svg>Мобильная версия</a></noindex>
			</div>
		</div>
	</div>
	<div class="copyright">
		<div class="in">
			<div class="row">
				<div class="counters span2">
					<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
	(function (d, w, c) {
		(w[c] = w[c] || []).push(function() {
			try {
				w.yaCounter48430814 = new Ya.Metrika({
					id:48430814,
					clickmap:true,
					trackLinks:true,
					accurateTrackBounce:true,
					webvisor:true
				});
			} catch(e) { }
		});

		var n = d.getElementsByTagName("script")[0],
				s = d.createElement("script"),
				f = function () { n.parentNode.insertBefore(s, n); };
		s.type = "text/javascript";
		s.async = true;
		s.src = "https://mc.yandex.ru/metrika/watch.js";

		if (w.opera == "[object Opera]") {
			d.addEventListener("DOMContentLoaded", f, false);
		} else { f(); }
	})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/48430814" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-149972174-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-149972174-1');
</script>
					&nbsp;
				</div>
				<div class="rights span5">
					Все права защищены. &copy; Сайт поддерживается <a href="https://group.am" target="_blank">ИП Михайлов В.С.</a><br />Дублирование контента разрешается только с прямой ссылкой на источник.
                                    <!-- <noindex><a href="https://adm.inavtospb.ru" target="_blank" rel="nofollow" class="signin">Вход</a></noindex> -->
				</div>
				<div class="inavto span2"><a title="сверисное обслуживание и ремонт Volvo в СПб" href="/" class="inavtoPlus">ИНАВТО+</a></div>
				<div class="volvo span3">
					<a href="/remont" title="ремонт VOLVO с 1992 года" class="repair">
						<em>Ремонт Volvo c 1992 года</em>
					</a>
				</div>
			</div>
		</div>
	</div>
</footer>

<div class="backdrop <?=Yii::$app->session->hasFlash('show') ? Yii::$app->session->getFlash('show') : ''; ?><?=Yii::$app->session->hasFlash('show1') ? Yii::$app->session->getFlash('show1') : ''; ?><?=Yii::$app->session->hasFlash('show2') ? Yii::$app->session->getFlash('show2') : ''; ?>"></div>
</body>
</html>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
