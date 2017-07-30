<?php

namespace Avem;

use Illuminate\Http\Request;

trait ManagesTagsTrait
{
	function requireTags(array $tags)
	{
		$existingTags = Tag::whereIn('name', $tags)->get();
		$existingTagNames = $existingTags->pluck('name')->toArray();
		$otherTagNames = array_diff($tags, $existingTagNames);
		Tag::insert(array_map(function($tagName) {
			return [ 'name' => $tagName ];
		}, $otherTagNames));

		$otherTags = Tag::whereIn('name', $otherTagNames)->get();
		return $existingTags->merge($otherTags);
	}

	function inputTags(Request $request, $name)
	{
		$tags = explode(',', $request->input($name));
		$tags = array_map('trim', $tags);
		return $this->requireTags($tags);
	}
}
