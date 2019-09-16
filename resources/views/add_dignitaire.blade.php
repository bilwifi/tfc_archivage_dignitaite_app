@extends("layouts.master")
@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/cropie.css') }}">

    <style type="text/css">
    	.nounderline, .violet{
    	    color: #7c4dff !important;
    	}
    	.btn-dark {
    	    background-color: #7c4dff !important;
    	    border-color: #7c4dff !important;
    	}
    	.btn-dark .file-upload {
    	    width: 100%;
    	    padding: 10px 0px;
    	    position: absolute;
    	    left: 0;
    	    opacity: 0;
    	    cursor: pointer;
    	}
    	.profile-img img{
    	    width: 200px;
    	    height: 200px;
    	    border-radius: 50%;
    	}    
    </style>
@endpush
@section('content')
<div class="row justify-content-center">
	
	<div class="card col-9 text-monospace bg-dark text-white">
		<div class="card-header">Ajouter</div>
		<div class="card-body">
            @include('partials._msgFlash')
			<div class="row">
	            <div class="col-sm-6">
	                <form  method="POST" id="myForm">
	                    @csrf
	                    <div class="form-group">
	                      <label for="nom">Nom</label>
	                      <input type="text" class="form-control" id="nom" placeholder="" name="nom" value="{{ old('nom') }}" required="">
	                    </div>
	                    <div class="form-group">
	                      <label for="postnom">Postnom</label>
	                      <input type="text" class="form-control" id="postnom" placeholder="" name="postnom" value="{{ old('postnom') }}">
	                    </div>
	                    <div class="form-group">
	                      <label for="prenom">Prenom</label>
	                      <input type="text" class="form-control" id="prenom" placeholder="" name="prenom" value="{{ old('prenom') }}" required="">
	                    </div>
	                   
	                    <div class="form-group">
	                      <label for="lieu_naissance">Lieu de naissance</label>
	                      <input type="text" class="form-control" id="lieu_naissance" placeholder="" name="lieu_naissance" value="{{ old('lieu_naissance') }}" required="">
	                    </div>
	                    <div class="form-group">
	                      <label for="date_naissance">Date de naissance</label>
	                      <input type="date" class="form-control" id="date_naissance" placeholder="" name="date_naissance" value="{{ old('date_naissance') }}" required="">
	                    </div>
	                    <div class="form-check">
                          <input class="form-check-input" type="checkbox"  id="defaultCheck1">
                          <label class="form-check-label" for="defaultCheck1">
                            Décéder
                          </label>
                        </div>
                        <div class="form-group" id="date_deces_field" hidden="">
                          <label for="date_deces">Date de décès</label>
                          <input type="date" class="form-control" id="date_deces" placeholder="" name="date_deces" value="{{ old('date_deces') }}" >
                        </div>
	                    
	                
	              </div>
	              
	            <div class="col-sm-6">
	                <div class="row">
	                    {{-- CROPIE --}}
	                    {{-- <div  class="container"> 
					    <div class="d-flex justify-content-center p-3">
					        <div class="card text-center">
					            <div class="card-body">
					                <h5 class="card-title"></h5>
					                <div class="profile-img p-3">
					                    {{-- <img src="#" id="profile-pic"> --}}
					                    {{-- <div id="resizer"></div>
					                </div>
					                <div class="btn btn-dark">
					                    <input type="file" class="file-upload" id="file-upload" 
					                    name="profile_picture" accept="image/*">
					                    Sélectionner une image 
					                </div>
					            </div>
					        </div>
					    </div> --}} 

					    <!-- The Modal -->
					  {{--   <div class="modal" id="myModal">
					        <div class="modal-dialog modal-dialog-centered">
					            <div class="modal-content">
					                <!-- Modal Header -->
					                <div class="modal-header">
					                    <h4 class="modal-title">Crop Image And Upload</h4>
					                    <button type="button" class="close" data-dismiss="modal">&times;</button>
					                </div>
					                <!-- Modal body -->
					                <div class="modal-body">
					                    <div id="resizer"></div>
					                    <button class="btn rotate float-lef" data-deg="90" > 
					                    <i class="fas fa-undo"></i></button>
					                    <button class="btn rotate float-right" data-deg="-90" > 
					                    <i class="fas fa-redo"></i></button>
					                    <hr>
					                    <button class="btn btn-block btn-dark" id="upload" > 
					                    Recadrer</button>
					                </div>
					            </div>
					        </div>
					    </div>
 --}}

					{{-- </div> --}}
	                    {{-- END CROPIE --}}
	                </div>
	                <div class="">
	                	<div class="form-group">
	                      <label for="fonction">Fonction</label>
	                      <input type="text" class="form-control" id="fonction" placeholder="" name="fonction" value="{{ old('fonction') }}" required="">
	                    </div>
	                    <div class="form-group">
	                      <label for="nationalite">Nationalité</label>
	                      <input type="text" class="form-control" id="nationalite" placeholder="" name="nationalite" value="{{ old('nationalite') }}" required="">
	                    </div>
	                     <div class="form-group">
	                        <label for="medaille">Distinction honorifique</label>
	                        <select class="form-control" id="medaille" required="" name="idmedailles">
	                          @foreach(App\Models\Medaille::get() as $m)
	                          <option value="{{ $m->idmedailles }}">{{ $m->lib }}</option>
	                          @endforeach
	                        </select>
	                      </div>
	                      <div class="form-group">
	                          <label for="date_decoration">Date de décoration</label>
	                          <input type="date" class="form-control" id="date_decoration" placeholder="" name="date_decoration" value="{{ old('date_decoration') }}">
	                    </div>
	                    <div class="form-group">
	                      <label for="num_brevet">N° Brevet</label>
	                      <input type="text" class="form-control" id="num_brevet" placeholder="" name="num_brevet" value="{{ old('num_brevet') }}">
	                    </div>
	                </div>  
	                <div class="modal-footer">
	                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button> --}}
	                <button type="submit" class="btn btn-primary">Enregistrer</button>
	              </div>
	              </form>
	            </div>
	        </div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('js/cropie.js') }}"></script>

<script type="text/javascript">
    $('#defaultCheck1').on("change",function(e){
        var chk = $('#defaultCheck1');
        if (chk[0].checked) {
            $('#date_deces_field').attr('hidden',false);
        }else{
            $('#date_deces_field').attr('hidden',true);
        }
    });
</script>

<script type="text/javascript">
 $(function() {
    var croppie = null;
    var el = document.getElementById('resizer');

    $.base64ImageToBlob = function(str) {
        // extract content type and base64 payload from original string
        var pos = str.indexOf(';base64,');
        var type = str.substring(5, pos);
        var b64 = str.substr(pos + 8);
      
        // decode base64
        var imageContent = atob(b64);
      
        // create an ArrayBuffer and a view (as unsigned 8-bit)
        var buffer = new ArrayBuffer(imageContent.length);
        var view = new Uint8Array(buffer);
      
        // fill the view, using the decoded base64
        for (var n = 0; n < imageContent.length; n++) {
          view[n] = imageContent.charCodeAt(n);
        }
      
        // convert ArrayBuffer to Blob
        var blob = new Blob([buffer], { type: type });
      
        return blob;
    }

    $.getImage = function(input, croppie) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {  
                croppie.bind({
                    url: e.target.result,
                });
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#file-upload").on("change", function(event) {
        // $("#myModal").modal();
        // Initailize croppie instance and assign it to global variable
        croppie = new Croppie(el, {
                viewport: {
                    width: 200,
                    height: 200,
                    // type: 'circle'
                },
                boundary: {
                    width: 250,
                    height: 250
                },
                enableOrientation: true
            });
        $.getImage(event.target, croppie); 
    });

    $("#upload").on("click", function() {
        croppie.result('base64').then(function(base64) {
            $("#myModal").modal("hide"); 
            $("#profile-pic").attr("src","/images/ajax-loader.gif");

            var url = "#";
            // var formData = new FormData();
            var formData = $('#myForm');
            formData.append("profile_picture", $.base64ImageToBlob(base64));
            $('#profile-pic').html($.base64ImageToBlob(base64));
            // formData.append("idusers", "user");

            // This step is only needed if you are using Laravel
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

            // $.ajax({
            //     type: 'POST',
            //     url: url,
            //     data: formData,
            //     processData: false,
            //     contentType: false,
            //     success: function(data) {
            //         if (data == "uploaded") {
            //            return location = "" ;
            //         } else {
            //             $("#profile-pic").attr("src","#"); 
            //             console.log(data['profile_picture']);
            //         }
            //     },
            //     error: function(error) {
            //         console.log(error);
            //         $("#profile-pic").attr("src","#"); 
            //     }
            // });
        });
    });

    // To Rotate Image Left or Right
    $(".rotate").on("click", function() {
        croppie.rotate(parseInt($(this).data('deg'))); 
    });

    $('#myModal').on('hidden.bs.modal', function (e) {
        // This function will call immediately after model close
        // To ensure that old croppie instance is destroyed on every model close
        setTimeout(function() { croppie.destroy(); }, 100);
    })

}); 
</script>
@endpush