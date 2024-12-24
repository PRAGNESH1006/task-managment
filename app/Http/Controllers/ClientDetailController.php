<?php

namespace App\Http\Controllers;

use App\Models\ClientDetail;
use App\Repositories\ClientDetailRepository;
use App\Http\Requests\StoreClientDetailRequest;
use App\Http\Requests\UpdateClientDetailRequest;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Throwable;

class ClientDetailController extends BaseController
{
    protected ClientDetailRepository $clientDetailRepository;
    protected UserRepository $userRepository;

    public function __construct(ClientDetailRepository $clientDetailRepository, UserRepository $userRepository)
    {
        $this->clientDetailRepository = $clientDetailRepository;
        $this->userRepository = $userRepository;
    }

    public function index(): View
    {
        $clientDetails = $this->clientDetailRepository->getAll();
        return view('clientDetails.index', compact('clientDetails'));
    }

    public function show(ClientDetail $clientDetail): View
    {
        return view('clientDetails.show', compact('clientDetail'));
    }

    public function create(): View
    {
        $clients = $this->userRepository->getAllUserByRole('client');
        return view('clientDetails.create', compact('clients'));
    }

    public function store(StoreClientDetailRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->clientDetailRepository->store($request->getInsertableFields());
            DB::commit();
            return $this->sendRedirectResponse(route('client-details.index'), 'Client Detail Added Successfully');
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->sendRedirectBackError($e->getMessage());
        }
    }

    public function edit(ClientDetail $clientDetail): View
    {
        $clientDetail = $this->clientDetailRepository->getById($clientDetail->id);
        return view('clientDetails.edit', compact('clientDetail'));
    }

    public function update(ClientDetail $clientDetail, UpdateClientDetailRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->clientDetailRepository->update($clientDetail->id, $request->getInsertableFields());
            DB::commit();
            return $this->sendRedirectResponse(route('client-details.index'), 'Client Detail Updated Successfully');
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->sendRedirectBackError($e->getMessage());
        }
    }

    public function destroy(ClientDetail $clientDetail): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->clientDetailRepository->destroy($clientDetail->id);
            DB::commit();
            return $this->sendRedirectResponse(route('clientDetails.index'), 'Client Detail Deleted Successfully');
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->sendRedirectError(route('clientDetails.index'), $e->getMessage());
        }
    }
}
