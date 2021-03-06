@extends('shop::base')
@section('aimeos_header')
    <?= $aiheader['locale/select'] ?? '' ?>
    <?= $aiheader['basket/mini'] ?? '' ?>
    <?= $aiheader['catalog/filter'] ?? '' ?>
    <?= $aiheader['catalog/search'] ?? '' ?>
    <?= $aiheader['catalog/tree'] ?? '' ?>
    <?= $aiheader['catalog/price'] ?? '' ?>
    <?= $aiheader['catalog/supplier'] ?? '' ?>
    <?= $aiheader['catalog/property'] ?? '' ?>
    <?= $aiheader['catalog/attribute'] ?? '' ?>
    <?= $aiheader['catalog/lists'] ?? '' ?>

@stop

@section('aimeos_head')
    <?= $aibody['locale/select'] ?? '' ?>
    <?= $aibody['basket/mini'] ?? '' ?>
@stop

@section('aimeos_nav')
    <?= $aibody['catalog/filter'] ?? '' ?>
    <?= $aibody['catalog/search'] ?? '' ?>
    <?= $aibody['catalog/tree'] ?? '' ?>
    <?= $aibody['catalog/price'] ?? '' ?>
    <?= $aibody['catalog/property'] ?? '' ?>
    <?= $aibody['catalog/supplier'] ?? '' ?>
    <?= $aibody['catalog/attribute'] ?? '' ?>
@stop

@section('aimeos_stage')
    <?= $aibody['catalog/stage'] ?? '' ?>
@stop

@section('aimeos_body')
<?= $aibody['basket/mini'] ?? '' ?>
     <?= $aibody['catalog/lists'] ?? '' ?>
@stop
