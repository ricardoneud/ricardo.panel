{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.admin')

@section('title')
    {{ $node->name }}: Servers
@endsection

@section('content-header')
    <h1>{{ $node->name }}<small>All servers currently assigned to this node.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.nodes') }}">Nodes</a></li>
        <li><a href="{{ route('admin.nodes.view', $node->id) }}">{{ $node->name }}</a></li>
        <li class="active">Servers</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-custom nav-tabs-floating">
            <ul class="nav nav-tabs">
                <li><a href="{{ route('admin.nodes.view', $node->id) }}">About</a></li>
                <li><a href="{{ route('admin.nodes.view.settings', $node->id) }}">Settings</a></li>
                <li><a href="{{ route('admin.nodes.view.configuration', $node->id) }}">Configuration</a></li>
                <li><a href="{{ route('admin.nodes.view.allocation', $node->id) }}">Allocation</a></li>
                <li class="active"><a href="{{ route('admin.nodes.view.servers', $node->id) }}">Servers</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-md-4">
        <div class="info-box bg-blue">
            <span class="info-box-icon"><i class="ion ion-ios-barcode-outline"></i></span>
            <div class="info-box-content number-info-box-content">
                <span class="info-box-text">Total RAM</span>
                <span class="info-box-number" id="ramUsage">Waiting for data</span>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-4">
        <div class="info-box bg-blue">
            <span class="info-box-icon"><i class="ion ion-stats-bars"></i></span>
            <div class="info-box-content number-info-box-content">
                <span class="info-box-text">Total Disk Space</span>
                <span class="info-box-number" id="diskUsage">Waiting for data</span>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-4">
        <div class="info-box bg-blue">
            <span class="info-box-icon"><i class="fa fa-microchip"></i></span>
            <div class="info-box-content number-info-box-content">
                <span class="info-box-text">Total CPU usage</span>
                <span class="info-box-number" id="cpuUsage">Waiting for data</span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Process Manager</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Server Name</th>
                        <th>Owner</th>
                        <th>Service</th>
                        <th class="text-center">Memory</th>
                        <th class="text-center">Disk</th>
                        <th class="text-center">CPU</th>
                        <th class="text-center">Status</th>
                    </tr>
                    @foreach($servers as $server)
                        <tr data-server="{{ $server->uuid }}">
                            <td><code>{{ $server->uuidShort }}</code></td>
                            <td><a href="{{ route('admin.servers.view', $server->id) }}">{{ $server->name }}</a></td>
                            <td><a href="{{ route('admin.users.view', $server->owner_id) }}">{{ $server->user->username }}</a></td>
                            <td>{{ $server->nest->name }} ({{ $server->egg->name }})</td>
                            <td class="text-center"><span data-action="memory">--</span> / {{ $server->memory === 0 ? '∞' : $server->memory }} MB</td>
                            <td class="text-center"><span data-action="disk">--</span> / {{ $server->disk === 0 ? '∞' : $server->disk }} MB </td>
							<td class="text-center"><span data-action="cpu" data-cpumax="{{ $server->cpu }}">--</span> %</td>
                            <td class="text-center" data-action="status">--</td>
                        </tr>
                    @endforeach
                </table>
                @if($servers->hasPages())
                    <div class="box-footer with-border">
                        <div class="col-md-12 text-center">{!! $servers->render() !!}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
    @parent
    {!! Theme::js('js/admin/node/view-servers.js') !!}
@endsection
