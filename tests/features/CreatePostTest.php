<?php

class CreatePostTest extends FeatureTestCase
{
	public function testUserCreatePost()
	{
		// Variables a enviar
		$title = 'Esta es una pregunta';
		$content = 'Este es el contenido';
		$user = $this->defaultUser();

		// Conectamos el usuario
		$this->actingAs($user);

		// Visitamos la página y enviamos el formulario con las variables
		$this->visit(route('posts.create'))
			->type($title, 'title')
			->type($content, 'content')
			->press('Publicar');

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
}