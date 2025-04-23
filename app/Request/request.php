<?php

class Request
{
  public static function all()
  {
    return $_POST ?? [];
  }
}