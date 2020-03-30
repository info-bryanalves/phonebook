@extends('layout.template')

@section('content')

<main class="page-container">
    <header class="page-header">
        <span class="default-color">Clientes</span>
        <a href="/clientes/criar" class="btn btn-info"><i class="fas fa-plus"></i>&nbsp;Adicionar cliente</a>
    </header>
    <div class="table-responsive-md">
        <table class="table">
            <thead class="default-background text-white">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col" class="text-center">Telefones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td class="text-center">
                        <button type="button" class="btn"
                            onclick="openPhoneModal({{ $customer->id }}, '{{ $customer->name }}')">
                            <img src="/phone.png" style="width:28px">
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="phoneModal" tabindex="-1" role="dialog" aria-labelledby="phone-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title default-color" id="phone-modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span class="default-color-dark">Detalhes do contato</span>
                <div id="phone-message" class="alert alert-info mt-1 mb-0">ae</div>
                <div class="phone-list">
                    <ul id="phonenumber-list">
                        Carregando...
                    </ul>
                </div>
                <div id="phone-add" class="phone-add">
                    <form onsubmit="return phoneStore(event)">
                        <div class="form-group">
                            <div class="d-flex">
                                <input type="text" onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" minlength="8" maxlength="11" class="form-control mr-3" id="phone-add-input"
                                    placeholder="Novo número" required>
                                <input type="hidden" id="phone-customer-id">
                                <input type="hidden" id="token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-info d-flex">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection