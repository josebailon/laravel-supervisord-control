<div class="container">
    @foreach($errors->all() as $msg)
    <div class="alert alert-warning alert-dismissible fade show fixed-bottom" role="alert">
        {{$msg}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endforeach

    <div class="row">
        <div class="col-sm">
            @switch($supervisord['state']['statecode'])
            @case(2)
            <?php $ssclass="danger" ?>
            @break
            @case(1)
            <?php $ssclass="success" ?>
            @break
            @case(0)
            <?php $ssclass="warning" ?>
            @break
            @default
            <?php $ssclass="warning" ?>
            @endswitch
            <h4 class="mb-5">Supervisord Status: <span class="badge badge-{{ $ssclass }}"> {{ $supervisord['state']['statename'] }}</span>
                @if($supervisord['state']['statecode']!=2)
                - <span>PID:</span> <span>{{ $supervisord['pid'] }}</span>
                <a href="{{ route('lsc_shutdown') }}" class="btn btn-danger btn-sm float-right ml-1">Shutdown Supervisord</a>

                <a href="{{ route('lsc_restart') }}" class="btn btn-success btn-sm float-right ml-1">Restart Supervisord</a>

                @endif
            </h4>
        </div>
    </div>

    {{-- groups loop --}}
    @foreach($processes as $key => $group)
    <div class="card mb-3">
        <div class="card-header">
            <h5>Group: {{ $key }}
                <a href="{{route('lsc_group_stop',$key)}}" class="btn btn-danger btn-sm float-right ml-1">Stop all in group</a>


                <a href="{{route('lsc_group_start',$key)}}" class="btn btn-success btn-sm float-right ml-1">Restart all in group</a>


                <a href="{{route('lsc_index')}}" class="btn btn-secondary btn-sm float-right">Refresh</a>

            </h5>
        </div>
        <div class="card-body">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">State</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    {{-- processes loop --}}
                    @foreach($group as $key => $process)
                    @switch($process['state'])
                    @case(0){{-- stoped --}}
                    <?php $psclass="danger" ?>
                    @break
                    @case(10){{-- starting --}}
                    <?php $psclass="warning" ?>
                    @break
                    @case(20){{-- running --}}
                    <?php $psclass="success" ?>
                    @break
                    @case(30){{-- backoff --}}
                    <?php $psclass="warning" ?>
                    @break
                    @case(40){{-- stopping --}}
                    <?php $psclass="warning" ?>
                    @break
                    @case(100){{-- exited --}}
                    <?php $psclass="danger" ?>
                    @break
                    @case(200){{-- fatal --}}
                    <?php $psclass="danger" ?>
                    @break
                    @case(1000){{-- unknow --}}
                    <?php $psclass="secondary" ?>
                    @break
                    @default
                    <?php $ssclass="secondary" ?>
                    @endswitch
                    <tr>
                        <td>
                            <span class="badge badge-{{ $psclass }}">{{ $process['statename'] }}</span>
                        </td>
                        <td>
                            {{ $process['name']  }}
                        </td>
                        <td>
                            {{ $process['description']  }}
                        </td>
                        <td>
                            {{-- start button --}}
                            @if (in_array($process['state'],[0,30,40,100,200,1000]))
                            <a class="btn btn-success btn-sm" href="{{ route('lsc_proc_start',$process['group'].':'.$process['name'] ) }}">Start</a>

                            @endif

                            {{-- restart button 
                            @if (in_array($process['state'],[20]))
                            <a class="btn btn-success" href="{{ route('lsc_proc_restart',$process['group'].':'.$process['name'] ) }}">Restart</a>
                            @endif--}}


                            {{-- stop button --}}
                            @if(in_array($process['state'],[10,20,1000]))
                            <a class="btn btn-danger btn-sm" href="{{ route('lsc_proc_stop',$process['group'].':'.$process['name'] ) }}">Stop</a>

                            @endif
                        </td>
                    </tr>
                    @endforeach
                    {{-- end processes loop --}}
                </tbody>
            </table>
        </div>
    </div>
    @endforeach
    {{-- end groups loop --}}
</div>
