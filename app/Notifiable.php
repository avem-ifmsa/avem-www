<?php

namespace App;

interface Notifiable
{
	public function getNotifiableReceiversAttribute();
}
