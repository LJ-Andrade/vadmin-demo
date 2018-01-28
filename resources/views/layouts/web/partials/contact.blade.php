<div id="contact" class="container-fluid contact-section">
	<div class="container wow animated fadeIn">
		<div class="row inner">
			<div class="col-md-12 contact-form">
				<h2 sty>FORMULARIO DE CONTACTO</h2>
			{{-- <h1>CONTACTANOS !</h1> --}}
			{{--  <img src="{{asset('webimages/logos/main-logo.png')}}" class="wow animated zoomIn" data-wow-delay="1.5s" data-wow-duration="3s">  --}}
				<div class="inner">
					{!! Form::open(['id' => 'MainContactForm', 'class' => 'form-horizontal', 'method' => 'POST']) !!}
						<div class="form-group">
							{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingresá tu nombre/empresa', 'required']) !!}
						</div>
						<div class="form-group">
							{!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Ingresá tu teléfono', 'required']) !!}
						</div>
						<div class="form-group">
							{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Ingresá tu E-Mail', 'required']) !!}
						</div>
						<div class="form-group">
							{!! Form::textarea('message', null, ['size' => '30x5', 'class' => 'form-control', 'placeholder' => 'Dejanos tu pedido o consulta. Te responderemos cuanto antes']) !!}
						</div>
						{{ csrf_field() }}
						{!! Form::submit('Enviar', ['class' => 'contactBtn']) !!}	
					{!! Form::close() !!}
				</div>
				<div id="FormResponse"></div>
				<div id="FormSuccess" class="form-responses animated fadeIn Hidden">
					<i class="success ion-checkmark-round"></i>
					<h2>Mensaje Enviado !</h2> 
					Gracias por contactarse con nosotros. <br>
					Nos estaremos comunicando a la brevedad.
					<hr class="softhr">
				</div>
				<div id="FormError" class="form-responses animated fadeIn Hidden">
					<i class="error ion-close-round"></i>
					<h2>Ha ocurrido un error !</h2> 
					Intente comunicarse directamente por mail o teléfono <br>
					Gracias.
				</div>
			</div>
		</div>

		
	</div>
</div>