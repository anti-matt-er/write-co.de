@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
  <aside>
    <nav>
      <button data-wc-button="Home"></button>
      <button data-wc-button="Articles"></button>
      <button data-wc-button="Media"></button>
      <button data-wc-button="Comments"></button>
      <button data-wc-button="Config"></button>
      <button data-wc-button="Tools"></button>
      <button data-wc-button="Write"></button>
    </nav>
  </aside>
  <main>
    <h1>Dashboard</h1>
    <nav>
      <button data-wc-button="Articles"></button>
      <button data-wc-button="Media"></button>
      <button data-wc-button="Comments"></button>
      <button data-wc-button="Config"></button>
      <button data-wc-button="Tools"></button>
      <button data-wc-button="Write"></button>
    </nav>
  </main>
@endsection
