@extends('layouts.backend.app')

@section('content')

    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Service</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Add Service</li>
                </ol>
            </div>

        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- Row -->
        <div class="row">
            <!-- Column -->

            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <div class="card-block">
                        <form action="{{ route('service_provider.service.store') }}" method="post" class="form-horizontal form-material" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                                <label class="col-md-12">Service Name</label>
                                <div class="col-md-12">
                                    <input type="text" name="product_name" class="form-control form-control-line">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-12">Price</label>
                                <div class="col-md-12">
                                    <input type="text" name="price" class="form-control form-control-line">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-12">Image</label>
                                <div class="col-md-12">
                                    <input type="file" name="photos[]" class="form-control form-control-line" multiple>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-12">Select Category</label>
                                <div class="col-sm-12">
                                    <select name="category" id="category" class="form-control form-control-line">

                                        <option selected disabled>Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-12">Select sub category</label>
                                <div class="col-sm-12">
                                    <select name="subcategory" id="subcategory" class="form-control form-control-line">

                                        

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-12">Select Type</label>
                                <div class="col-sm-12">
                                    <select name="pro_type" class="form-control form-control-line">

                                        <option value="1">Feature</option>
                                        <option value="0">Non-Feature</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-12">Service Details</label>
                                <div class="col-md-12">
                                    <textarea name="product_details" rows="5" class="form-control form-control-line"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-success">Add Service</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
        <!-- Row -->
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>

@endsection



@push('js')

 
<script>
 $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script>
        $(document).ready(function() {
        $('#category').on('change', function() {
            var categoryid = $(this).val();
            console.log(categoryid)
             if(categoryid) {


                $.ajax({

                   // url: '/finddsubcategory/'+categoryid,
                    url: '/Ecommerce/finddsubcategory/'+categoryid,
                    
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                      if(data){

                       // console.log(data);

                            $('#subcategory').empty();
                            $('#subcategory').focus;
                            $('#subcategory').append('<option value="">-- Select subcategory --</option>'); 
                            $.each(data, function(key, value){
                            $("#subcategory").append('<option value="'+ value.id +'">' + value.name+ '</option>');
                           });

                      }else{

                         $('#subcategory').empty();
                       // console.log("data not found");

                      }
                  }

                });


            }else{

                  $('#subcategory').empty();
            }


           });
        });

    </script>

@endpush