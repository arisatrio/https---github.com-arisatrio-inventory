  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $pageHeader }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                   {{ $breadcrumb  }}
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
           <div class="col-12">

            <div>
                @if(\Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {!! \Session::get('success') !!}
                    </div>
                @endif
            
                @if(\Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {!! \Session::get('error') !!}
                    </div>
                @endif
            
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="p-0 m-0" style="list-style: none;">
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>    
                    </div>
                @endif
            </div>

            {{ $content }}
           </div>
        </div>
    </div>
</div>