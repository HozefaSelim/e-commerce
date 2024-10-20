<!DOCTYPE html>
<html lang="en">
	
    @include('partials.head')


	<body>



        @include('partials.nav')

        @include('partials.alerts')

    @yield("main-content")
	



	@include('partials.footer')



    @include('partials.scripts')

    @yield("scripts")

	</body>
</html>
