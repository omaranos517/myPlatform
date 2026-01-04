@extends('layouts.error')

@section('error-code', '403')
@section('error-title', 'غير مصرح بالوصول')
@section('error-description', 'ليس لديك صلاحية لعرض هذه الصفحة.')
@section('error-icon', 'fas fa-lock')
