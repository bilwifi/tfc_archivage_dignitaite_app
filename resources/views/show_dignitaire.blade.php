@extends('layouts.master')
@push('stylesheets')
	<style type="text/css">
		.table td, .table th{
			    border-top: 0px;
		}
	</style>
@endpush
@section('content')
<div class="card bg-dark text-white d-flex justify-content-center">
	<div class="card-body">
		<div class="row">
				<div class="col-6">
					<div class="card bg-dark border-bottom ">
			        	<div class="card-header  ">{{ $dignitaire->prenom .' '.$dignitaire->nom }}</div>
			        	<div class="card-body">
			        		<div class="row d-flex ">
			        			<div class="col-12 d-flex justify-content-center ">
									<img src="{{ img_profil($dignitaire->iddignitaires) }}" class="img-fluid " alt="Bil" width="200" height="200"><a href="{{ route('edit_picture_user',$dignitaire->iddignitaires) }}"><i class="fas fa-edit"></i></a>			
			        			</div>
			        		</div>
			                <br>
			                <br>
			            <div class="row">
			            <div class="card bg-dark col-12 d-flex justify-content-center" >
			              {{-- <div class="card-header">Identité</div> --}}
			              <div class="card-body">
			                <table class="table table-striped bg-dark border-top-0 ">
			                 {{--  <thead>
			                    <tr>
			                      <th scope="col">#</th>
			                      <th scope="col">First</th>
			                      <th scope="col">Last</th>
			                      <th scope="col">Handle</th>
			                    </tr>
			                  </thead> --}}
			                  <tbody class="">
			                    <tr class="border-top-0">
			                      <th scope="row">Nom</th>
			                      <td>{{ $dignitaire->nom }}</td>
			                    </tr>
			                    <tr>
			                      <th scope="row">Postom</th>
			                      <td>{{ $dignitaire->postnom }}</td>
			                    </tr>
			                    <tr>
			                      <th scope="row">Prenom</th>
			                      <td>{{ $dignitaire->prenom }}</td>
			                    </tr>
			                    <tr>
			                      <th scope="row">Lieu de naissance</th>
			                      <td>{{ $dignitaire->lieu_naissance }}</td>
			                    </tr>
			                    <tr>
			                      <th scope="row">Date de naissance</th>
			                      <td>{{ $dignitaire->date_naissance }}</td>
			                    </tr>
			                    @if($dignitaire->date_deces != null)
			                    <tr>
			                      <th scope="row">Date de decès</th>
			                      <td>{{ $dignitaire->date_deces }}</td>
			                    </tr>
			                    @endif
			                    <tr>
			                      <th scope="row">Fonction</th>
			                      <td>{{ $dignitaire->fonction }}</td>
			                    </tr>
			                    <tr>
			                      <th scope="row">Nationalité</th>
			                      <td>{{ $dignitaire->nationalite }}</td>
			                    </tr>
			                   
			                    
			                  </tbody>
			                </table>
			              </div>
			            </div>
			          </div>
		        	</div>
		        </div>
				</div>
			<div class="col-md-6">
				<div class="card bg-dark border-bottom " style="border-radius: 10px; max-height: 700px"  >
		            <div class="card-header bg-dark">
		                <h6 class="card-title text-white">Titres honorifiques</h6>
		            </div>
		          <div class="card-body border-dark scroll-panel" style="position: relative;overflow-y: scroll;" >
		            <div class="row">
		                @if($titres->isNotEmpty())
		                @foreach($titres as $titre)
		                    <div class="col-12">
		                       <div class="card border bg-dark text-white" style="border-radius: 10px" >
		                          {{-- <img class="card-img-top img-fluid" src="{{ asset('img/test.png') }}" alt="Card image cap"> --}}
		                          <div class="card-body">
		                            <h5 class="card-title">Médaille : {{ $titre->lib }}</h5>
		                            <p class="card-text">Date de décoration : {{ $titre->date_decoration }}</p>
		                            <div class="justify-content-end ">
		                                <button type="button" class="view-medaille btn btn-primary btn-sm" data-toggle="modal" data-target="#view-medaille_modal" data-links="{{ route('show_medaille',$titre->idmedailles) }}"> En savoir plus </button>
		                            </div>
		                          </div>
		                        </div> 
		                    <br>
		                    </div>
		                    @endforeach
		                 @else
		                 <div class="alert alert-light" role="alert">
		                  Aucune titre disponible pour l'instant !
		                 </div>
		                 @endif

		            </div>
		            @auth()
		            <small class="d-block text-right mt-3">
			          <!-- Button trigger modal -->
						<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
					 	 Ajouter un titre
						</button>
			        </small>
			        

					<!-- Modal -->
					<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog " role="document">
					    <div class="modal-content">
					      <div class="modal-header bg-dark">
					        <h5 class="modal-title" id="exampleModalLabel">{{ $dignitaire->prenom .' '.$dignitaire->nom}}</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body bg-dark">
					        <form  method="POST" action="{{ route('add_titre') }}" id="myForm">
			                    @csrf
			                    <input type="text" value="{{ $dignitaire->iddignitaires }}" name="iddignitaires" hidden="" required="">
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
		                          <input type="date" class="form-control" id="date_decoration" placeholder="" name="date_decoration" value="{{ old('date_decoration') }}" required="">
			                    </div>
			                    <div class="form-group">
			                      <label for="num_brevet">N° Brevet</label>
			                      <input type="text" class="form-control" id="num_brevet" placeholder="" name="num_brevet" value="{{ old('num_brevet') }}" required="">
			                    </div>
	               			
					      </div>
					      <div class="modal-footer bg-dark">
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
					        <button type="submit" class="btn btn-primary">Ajouter</button>
					      </div>
					      </form>
					    </div>
					  </div>
					</div>
			        @endauth
		          </div>

		        </div>
		    </div>
		</div>
	</div>
</div>

<div class="modal fade" id="view-medaille_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
	    <div class="modal-content">
	      {{-- <div class="modal-header bg-dark">
	        <h5 class="modal-title" id="exampleModalLabel">{{ $dignitaire->prenom .' '.$dignitaire->nom}}</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div> --}}
	      <div class="modal-body ">
	    	<div id="data-view-medaille"></div>
	      </div>
	  </div>
	</div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">
        $('.view-medaille').on('click', function(e) {
        e.preventDefault();
        var links = $(this).data('links');
        $.ajax({
            type: 'get',
            url: links,
            success: function(data) {
                $('#data-view-medaille').html(data);
                
            },
            error:function(data) {
                var errors = data.responseJSON.errors;
                  $.each(errors, function (key, value) {
                    document.getElementById('msgErrors').innerHTML += "<li>"+value+"</li>"
                    $('#msgErrors').removeAttr('hidden');
                });
            }
        });
    });
</script>
@endpush