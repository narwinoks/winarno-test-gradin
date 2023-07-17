<?php

namespace App\Interface;

interface CourierInterface
{
  public  function index($request);
  public  function show($id);
  public  function store($data);
  public  function update($olData,$newData);

  public  function delete($data);
}
