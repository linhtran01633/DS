<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ClientController::class, 'index'])->name('client.index');
Route::get('/detail', [ClientController::class, 'detail'])->name('client.detail');
Route::get('/gới-thiệu', [ClientController::class, 'introduce'])->name('client.introduce');
Route::get('/liên-hệ', [ClientController::class, 'contact'])->name('client.contact');
Route::get('/giỏ-hàng', [ClientController::class, 'shoppingCard'])->name('client.shoppingCard');
Route::get('/shopping_card', [ClientController::class, 'shopping_card'])->name('client.shopping_card');
Route::get('/tin-tức', [ClientController::class, 'news'])->name('client.news');
Route::get('/tin-tức-chi-tiết', [ClientController::class, 'detailNews'])->name('client.detail.news');
Route::post('/invoice', [ClientController::class, 'invoice'])->name('client.invoice');

Route::post('/profile', [ProfileController::class, 'destroy'])->name('category.create');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/đăng-nhập', [LoginController::class, 'index'])->name('login.index');
Route::post('/login_admin', [LoginController::class, 'login_admin'])->name('login.admin.post');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/admin/dashboard/category', [AdminController::class, 'categoryIndex'])->name('admin.category.index');
    Route::post('/admin/dashboard/categoryAdd', [AdminController::class, 'categoryAdd'])->name('admin.category.add');
    Route::post('/admin/dashboard/categoryEdit', [AdminController::class, 'categoryEdit'])->name('admin.category.edit');
    Route::post('/admin/dashboard/categoryDelete', [AdminController::class, 'categoryDelete'])->name('admin.category.delete');

    Route::get('/admin/dashboard/product', [AdminController::class, 'productIndex'])->name('admin.product.index');
    Route::get('/admin/dashboard/productDetail', [AdminController::class, 'productDetail'])->name('admin.product.detail');
    Route::post('/admin/dashboard/productAdd', [AdminController::class, 'productAdd'])->name('admin.product.add');
    Route::post('/admin/dashboard/productEdit', [AdminController::class, 'productEdit'])->name('admin.product.edit');
    Route::post('/admin/dashboard/productDelete', [AdminController::class, 'productDelete'])->name('admin.product.delete');

    Route::get('/admin/dashboard/news', [AdminController::class, 'newsIndex'])->name('admin.news.index');
    Route::get('/admin/dashboard/newsDetail', [AdminController::class, 'newsDetail'])->name('admin.news.detail');
    Route::post('/admin/dashboard/newsAdd', [AdminController::class, 'newsAdd'])->name('admin.news.add');
    Route::post('/admin/dashboard/newsEdit', [AdminController::class, 'newsEdit'])->name('admin.news.edit');
    Route::post('/admin/dashboard/newsDelete', [AdminController::class, 'newsDelete'])->name('admin.news.delete');

    Route::get('/admin/dashboard/invoice', [AdminController::class, 'invoiceIndex'])->name('admin.invoice.index');
    Route::post('/admin/dashboard/invoiceEdit', [AdminController::class, 'invoiceEdit'])->name('admin.invoice.edit');
    Route::get('/admin/dashboard/invoiceDetail', [AdminController::class, 'invoiceDetail'])->name('admin.invoice.detail');

    Route::get('/admin/dashboard/users', [AdminController::class, 'userIndex'])->name('admin.user.index');
    Route::post('/admin/dashboard/usersAdd', [AdminController::class, 'userAdd'])->name('admin.user.add');
    Route::post('/admin/dashboard/usersDelete', [AdminController::class, 'userDelete'])->name('admin.user.delete');

    Route::get('/admin/dashboard/clinic', [AdminController::class, 'clinicIndex'])->name('admin.clinic.index');

    Route::post('/admin/dashboard/genericAdd', [AdminController::class, 'addGeneric'])->name('admin.generic.add');
    Route::post('/admin/dashboard/genericEdit', [AdminController::class, 'editGeneric'])->name('admin.generic.edit');
    Route::get('/admin/dashboard/genericDelete', [AdminController::class, 'genericDelete'])->name('admin.generic.delete');

    Route::post('/admin/dashboard/drugUnitAdd', [AdminController::class, 'addDrugUnit'])->name('admin.drugUnit.add');
    Route::post('/admin/dashboard/drugUnitEdit', [AdminController::class, 'editDrugUnit'])->name('admin.drugUnit.edit');
    Route::get('/admin/dashboard/drugUnitDelete', [AdminController::class, 'drugUnitDelete'])->name('admin.drugUnit.delete');

    Route::post('/admin/dashboard/usageAdd', [AdminController::class, 'addUsage'])->name('admin.usage.add');
    Route::post('/admin/dashboard/usageEdit', [AdminController::class, 'usageEdit'])->name('admin.usage.edit');
    Route::get('/admin/dashboard/usageDelete', [AdminController::class, 'usageDelete'])->name('admin.usage.delete');


    Route::post('/admin/dashboard/drugAdd', [AdminController::class, 'addDrug'])->name('admin.drug.add');
    Route::post('/admin/dashboard/drugEdit', [AdminController::class, 'editDrug'])->name('admin.drug.edit');
    Route::get('/admin/dashboard/drugDelete', [AdminController::class, 'drugDelete'])->name('admin.drug.delete');

    Route::post('/admin/dashboard/patientAdd', [AdminController::class, 'patientAdd'])->name('admin.patient.add');
    Route::post('/admin/dashboard/sickAdd', [AdminController::class, 'sickAdd'])->name('admin.sick.add');
    Route::post('/admin/dashboard/sickEdit', [AdminController::class, 'sickEdit'])->name('admin.sick.edit');
    Route::get('/admin/dashboard/listPatientSicks', [AdminController::class, 'listPatientSicks'])->name('admin.listPatientSicks');


    Route::post('/admin/dashboard/addPrescription', [AdminController::class, 'addPrescription'])->name('admin.addPrescription');
    Route::get('/admin/dashboard/listPrescription', [AdminController::class, 'listPrescription'])->name('admin.listPrescription');
    Route::post('/admin/dashboard/savePrescription', [AdminController::class, 'savePrescription'])->name('admin.savePrescription');

    Route::get('/admin/dashboard/dropdownGeneric', [AdminController::class, 'dropdownGeneric'])->name('admin.dropdownGeneric');
    Route::get('/admin/dashboard/dropdownDrugUnit', [AdminController::class, 'dropdownDrugUnit'])->name('admin.dropdownDrugUnit');

    Route::post('/logout_admin', [LoginController::class, 'logout_admin'])->name('logout_admin');

    Route::get('/admin/dashboard/generatePDF', [AdminController::class, 'generatePDF'])->name('admin.generatePDF');

});

require __DIR__.'/auth.php';
