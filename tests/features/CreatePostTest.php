<?php

class CreatePostTest extends FeatureTestCase
{
	public function test_a_user_create_a_post()
	{
		// Having
		// Variables a enviar
		$title = 'Esta es una pregunta';
		$content = 'Este es el contenido';
		$user = $this->defaultUser();

		// When
		// Conectamos el usuario
		$this->actingAs($user);

		// Visitamos la página y enviamos el formulario con las variables
		$this->visit(route('posts.create'))
			->type($title, 'title')
			->type($content, 'content')
			->press('Publicar');

		// Then
		// Comprobamos que se encuentra nuestro post en base de datos
		$this->seeInDatabase('posts', [
			'title'		=> $title,
			'content'	=> $content,
			'pending'	=> true,
			'user_id'	=> $user->id,
		]);

		// Comprobamos que el usuario es redirigido al post despues de crearlo
		$this->see($title);
	}

	public function test_creating_a_post_requires_authentication()
	{
		// When
		// Cuando un usuario no registrado intenta crear un post
		$this->visit(route('posts.create'));

		// Then
		// Comprobamos que el usuario no registrado es redirigido al login
		$this->seePageIs(route('login'));
	}

	public function test_create_post_form_validation()
	{
		$this->actingAs($this->defaultUser())
			->visit(route('posts.create'))
			->press('Publicar')
			->seePageIs(route('posts.create'))
			->seeErrors([
				'title' 	=> 'El campo título es obligatorio',
				'content'	=> 'El campo contenido es obligatorio',
			]);
	}
}