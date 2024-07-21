<!DOCTYPE html>
<html lang="en">
@extends('head')
<body>
<div id="app">
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <dashboard-component />
</div>
@extends('script')
</body>
</html>

