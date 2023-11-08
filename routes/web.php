<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\MedicController;
use App\Http\Controllers\ContainerController;
use App\Http\Controllers\SpecimenController;
use App\Http\Controllers\IndicationController;
use App\Http\Controllers\StudyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ThermometerController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\ReagentController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\QualityController;
use App\Http\Controllers\IncidentController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/users/documentupload/', [UserController::class, 'upload'])->name('users.upload');
Route::post('/users/documentdelete/', [UserController::class, 'delete'])->name('users.delete');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::post('/users/deactivate/{id}', [UserController::class, 'deactivate'])->name('users.deactivate');
Route::post('/users/activate/{id}', [UserController::class, 'activate'])->name('users.activate');

Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
Route::get('/roles/{role}', [RoleController::class, 'show'])->name('roles.show');
Route::get('/roles/edit/{role}', [RoleController::class, 'edit'])->name('roles.edit');
Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

Route::get('/quejas', function () {return view('lab.incidents.public');})->name('quejas');
Route::get('gracias/{id}', [IncidentController::class, 'gracias'])->name('incidents.gracias');

Route::get('incidents/mail/{id}', [IncidentController::class, 'mail'])->name('incidents.mail');
Route::get('incidents/actions/{id}', [IncidentController::class, 'actions'])->name('incidents.actions');
Route::post('incidents/storeactions/{id}', [IncidentController::class, 'storeactions'])->name('incidents.storeactions');
Route::post('incidents/finishaction/{id}', [IncidentController::class, 'finishaction'])->name('incidents.finishaction');
Route::get('incidents/solveaction/{id}', [IncidentController::class, 'solveaction'])->name('incidents.solveaction');
Route::put('incidents/{incident}/sendmail', [IncidentController::class, 'sendmail'])->name('incidents.sendmail');

Route::get('/incidents', [IncidentController::class, 'index'])->name('incidents.index');
Route::get('/incidents/contact', [IncidentController::class, 'contact'])->name('incidents.contact');
Route::get('/incidents/create', [IncidentController::class, 'create'])->name('incidents.create');
Route::post('/incidents', [IncidentController::class, 'store'])->name('incidents.store');
Route::get('/incidents/{incident}', [IncidentController::class, 'show'])->name('incidents.show');
Route::get('/incidents/edit/{incident}', [IncidentController::class, 'edit'])->name('incidents.edit');
Route::put('/incidents/{incident}', [IncidentController::class, 'update'])->name('incidents.update');
Route::delete('/incidents/{incident}', [IncidentController::class, 'destroy'])->name('incidents.destroy');
Route::get('/incidents/report/{id}', [IncidentController::class, 'report'])->name('incidents.report');
Route::post('/incidents/reports', [IncidentController::class, 'reports'])->name('incidents.reports');
Route::post('/incidents/storecontact', [IncidentController::class, 'storecontact'])->name('incidents.storecontact');
Route::post('/incidents/storepublic/', [IncidentController::class, 'storepublic'])->name('incidents.storepublic');

Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
Route::get('/clients/{client}', [ClientController::class, 'show'])->name('clients.show');
Route::get('/clients/edit/{client}', [ClientController::class, 'edit'])->name('clients.edit');
Route::put('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');
Route::post('/clients/deactivate/{id}', [ClientController::class, 'deactivate'])->name('clients.deactivate');
Route::post('/clients/activate/{id}', [ClientController::class, 'activate'])->name('clients.activate');
Route::get('clients/prices/{id}', [ClientController::class, 'prices'])->name('clients.prices');

Route::get('/providers', [ProviderController::class, 'index'])->name('providers.index');
Route::get('/providers/create', [ProviderController::class, 'create'])->name('providers.create');
Route::post('/providers', [ProviderController::class, 'store'])->name('providers.store');
Route::get('/providers/{provider}', [ProviderController::class, 'show'])->name('providers.show');
Route::get('/providers/edit/{provider}', [ProviderController::class, 'edit'])->name('providers.edit');
Route::put('/providers/{provider}', [ProviderController::class, 'update'])->name('providers.update');
Route::post('/providers/deactivate/{id}', [ProviderController::class, 'deactivate'])->name('providers.deactivate');
Route::post('/providers/activate/{id}', [ProviderController::class, 'activate'])->name('providers.activate');

Route::get('/areas', [AreaController::class, 'index'])->name('areas.index');
Route::get('/areas/create', [AreaController::class, 'create'])->name('areas.create');
Route::post('/areas', [AreaController::class, 'store'])->name('areas.store');
Route::get('/areas/{area}', [AreaController::class, 'show'])->name('areas.show');
Route::get('/areas/edit/{area}', [AreaController::class, 'edit'])->name('areas.edit');
Route::put('/areas/{area}', [AreaController::class, 'update'])->name('areas.update');
Route::delete('/areas/{area}', [AreaController::class, 'destroy'])->name('areas.destroy');

Route::get('/medics', [MedicController::class, 'index'])->name('medics.index');
Route::get('/medics/create', [MedicController::class, 'create'])->name('medics.create');
Route::post('/medics', [MedicController::class, 'store'])->name('medics.store');
Route::get('/medics/{medic}', [MedicController::class, 'show'])->name('medics.show');
Route::get('/medics/edit/{medic}', [MedicController::class, 'edit'])->name('medics.edit');
Route::put('/medics/{medic}', [MedicController::class, 'update'])->name('medics.update');
Route::post('/medics/deactivate/{id}', [MedicController::class, 'deactivate'])->name('medics.deactivate');
Route::post('/medics/activate/{id}', [MedicController::class, 'activate'])->name('medics.activate');

Route::get('/containers', [ContainerController::class, 'index'])->name('containers.index');
Route::get('/containers/create', [ContainerController::class, 'create'])->name('containers.create');
Route::post('/containers', [ContainerController::class, 'store'])->name('containers.store');
Route::get('/containers/{container}', [ContainerController::class, 'show'])->name('containers.show');
Route::get('/containers/edit/{container}', [ContainerController::class, 'edit'])->name('containers.edit');
Route::put('/containers/{container}', [ContainerController::class, 'update'])->name('containers.update');
Route::delete('/containers/{container}', [ContainerController::class, 'destroy'])->name('containers.destroy');

Route::get('/specimens', [SpecimenController::class, 'index'])->name('specimens.index');
Route::get('/specimens/create', [SpecimenController::class, 'create'])->name('specimens.create');
Route::post('/specimens', [SpecimenController::class, 'store'])->name('specimens.store');
Route::get('/specimens/{specimen}', [SpecimenController::class, 'show'])->name('specimens.show');
Route::get('/specimens/edit/{specimen}', [SpecimenController::class, 'edit'])->name('specimens.edit');
Route::put('/specimens/{specimen}', [SpecimenController::class, 'update'])->name('specimens.update');
Route::delete('/specimens/{specimen}', [SpecimenController::class, 'destroy'])->name('specimens.destroy');

Route::get('/indications', [IndicationController::class, 'index'])->name('indications.index');
Route::get('/indications/create', [IndicationController::class, 'create'])->name('indications.create');
Route::post('/indications', [IndicationController::class, 'store'])->name('indications.store');
Route::get('/indications/{indication}', [IndicationController::class, 'show'])->name('indications.show');
Route::get('/indications/edit/{indication}', [IndicationController::class, 'edit'])->name('indications.edit');
Route::put('/indications/{indication}', [IndicationController::class, 'update'])->name('indications.update');
Route::delete('/indications/{indication}', [IndicationController::class, 'destroy'])->name('indications.destroy');

Route::get('/studies/estudios', [StudyController::class, 'estudios'])->name('studies.estudios');
Route::get('/studies/alergenos', [StudyController::class, 'alergenos'])->name('studies.alergenos');
Route::get('/studies/perfiles', [StudyController::class, 'perfiles'])->name('studies.perfiles');
Route::get('/studies/report/{id}', [StudyController::class, 'report'])->name('studies.report');
Route::get('/studies/references/{id}', [StudyController::class, 'references'])->name('studies.references');
Route::post('/studies/storereport/', [StudyController::class, 'storereport'])->name('studies.storereport');
Route::post('/studies/storereferences/', [StudyController::class, 'storereferences'])->name('studies.storereferences');
Route::get('/studies', [StudyController::class, 'index'])->name('studies.index');
Route::get('/studies/create', [StudyController::class, 'create'])->name('studies.create');
Route::post('/studies', [StudyController::class, 'store'])->name('studies.store');
Route::get('/studies/{study}', [StudyController::class, 'show'])->name('studies.show');
Route::get('/studies/edit/{study}', [StudyController::class, 'edit'])->name('studies.edit');
Route::put('/studies/{study}', [StudyController::class, 'update'])->name('studies.update');
Route::post('/studies/deactivate/{id}', [StudyController::class, 'deactivate'])->name('studies.deactivate');
Route::post('/studies/activate/{id}', [StudyController::class, 'activate'])->name('studies.activate');

Route::get('/meetings', [MeetingController::class, 'index'])->name('meetings.index');
Route::get('/meetings/create', [MeetingController::class, 'create'])->name('meetings.create');
Route::post('/meetings', [MeetingController::class, 'store'])->name('meetings.store');
Route::get('/meetings/{event}', [MeetingController::class, 'show'])->name('meetings.show');
Route::get('/meetings/edit/{event}', [MeetingController::class, 'edit'])->name('meetings.edit');
Route::put('/meetings/{event}', [MeetingController::class, 'update'])->name('meetings.update');
Route::delete('/meetings/{event}', [MeetingController::class, 'destroy'])->name('meetings.destroy');

Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.index');
Route::get('/profiles/create', [ProfileController::class, 'create'])->name('profiles.create');
Route::post('/profiles/store', [ProfileController::class, 'store'])->name('profiles.store');
Route::get('/profiles/{profile}', [ProfileController::class, 'show'])->name('profiles.show');
Route::get('/profiles/edit/{profile}', [ProfileController::class, 'edit'])->name('profiles.edit');
Route::put('/profiles/{profile}', [ProfileController::class, 'update'])->name('profiles.update');
Route::post('/profiles/deactivate/{id}', [ProfileController::class, 'deactivate'])->name('profiles.deactivate');
Route::post('/profiles/activate/{id}', [ProfileController::class, 'activate'])->name('profiles.activate');

Route::get('/reagents', [ReagentController::class, 'index'])->name('reagents.index');
Route::get('/reagents/create', [ReagentController::class, 'create'])->name('reagents.create');
Route::get('/reagents/inventory', [ReagentController::class, 'inventory'])->name('reagents.inventory');
Route::post('reagents/use/{id}', [ReagentController::class, 'use'])->name('reagents.use');
Route::post('reagents/fin/{id}', [ReagentController::class, 'fin'])->name('reagents.fin');
Route::post('/reagents', [ReagentController::class, 'store'])->name('reagents.store');
Route::get('/reagents/request', [ReagentController::class, 'request'])->name('reagents.request');
Route::get('/reagents/{reagent}', [ReagentController::class, 'show'])->name('reagents.show');
Route::get('/reagents/edit/{reagent}', [ReagentController::class, 'edit'])->name('reagents.edit');
Route::put('/reagents/{reagent}', [ReagentController::class, 'update'])->name('reagents.update');
Route::delete('/reagents/{reagent}', [ReagentController::class, 'destroy'])->name('reagents.destroy');
Route::post('/reagents/storeRequest/', [ReagentController::class, 'storeRequest'])->name('reagents.storeRequest');

Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases.index');
Route::get('/purchases/receipt/{reagent}', [PurchaseController::class, 'receipt'])->name('purchases.receipt');
Route::get('/purchases/bought/{reagent}', [PurchaseController::class, 'bought'])->name('purchases.bought');
Route::get('/purchases/{reagent}', [PurchaseController::class, 'show'])->name('purchases.show');
Route::post('/purchases/storeBought', [PurchaseController::class, 'storeBought'])->name('purchases.storeBought');
Route::post('/purchases/storeReceipt', [PurchaseController::class, 'storeReceipt'])->name('purchases.storeReceipt');
Route::get('/purchases/report/{id}', [PurchaseController::class, 'report'])->name('purchases.report');

Route::get('/equipments', [EquipmentController::class, 'index'])->name('equipments.index');
Route::get('/equipments/create', [EquipmentController::class, 'create'])->name('equipments.create');
Route::post('/equipments', [EquipmentController::class, 'store'])->name('equipments.store');
Route::get('/equipments/{equipment}', [EquipmentController::class, 'show'])->name('equipments.show');
Route::get('/equipments/edit/{equipment}', [EquipmentController::class, 'edit'])->name('equipments.edit');
Route::put('/equipments/{equipment}', [EquipmentController::class, 'update'])->name('equipments.update');
Route::post('/equipments/deactivate/{id}', [EquipmentController::class, 'deactivate'])->name('equipments.deactivate');
Route::post('/equipments/activate/{id}', [EquipmentController::class, 'activate'])->name('equipments.activate');
Route::get('/equipments/label/{equipment}', [EquipmentController::class, 'label'])->name('equipments.label');
Route::get('/equipments/registermaintenance/{equipment}', [EquipmentController::class, 'registermaintenance'])->name('equipments.registermaintenance');
Route::patch('/equipments/registermaintenancestore/{equipment}', [EquipmentController::class, 'registermaintenancestore'])->name('equipments.registermaintenancestore');
Route::get('/equipments/maintenance/{equipment}', [EquipmentController::class, 'maintenance'])->name('equipments.maintenance');
Route::post('/equipments/maintenancestore', [EquipmentController::class, 'maintenancestore'])->name('equipments.maintenancestore');
Route::post('/equipments/maintenancereport', [EquipmentController::class, 'maintenancereport'])->name('equipments.maintenancereport');

Route::get('/thermometers', [ThermometerController::class, 'index'])->name('thermometers.index');
Route::get('/thermometers/create', [ThermometerController::class, 'create'])->name('thermometers.create');
Route::post('/thermometers', [ThermometerController::class, 'store'])->name('thermometers.store');
Route::get('/thermometers/{thermometer}', [ThermometerController::class, 'show'])->name('thermometers.show');
Route::get('/thermometers/edit/{thermometer}', [ThermometerController::class, 'edit'])->name('thermometers.edit');
Route::put('/thermometers/{thermometer}', [ThermometerController::class, 'update'])->name('thermometers.update');
Route::post('/thermometers/deactivate/{id}', [ThermometerController::class, 'deactivate'])->name('thermometers.deactivate');
Route::post('/thermometers/activate/{id}', [ThermometerController::class, 'activate'])->name('thermometers.activate');
Route::get('/thermometers/label/{thermometer}', [ThermometerController::class, 'label'])->name('thermometers.label');
Route::get('/thermometers/registertemperature/{thermometer}', [ThermometerController::class, 'registertemperature'])->name('thermometers.registertemperature');
Route::patch('/thermometers/registertemperaturestore/{thermometer}', [ThermometerController::class, 'registertemperaturestore'])->name('thermometers.registertemperaturestore');
Route::get('/thermometers/temperature/{thermometer}', [ThermometerController::class, 'temperature'])->name('thermometers.temperature');
Route::post('/thermometers/temperaturestore', [ThermometerController::class, 'temperaturestore'])->name('thermometers.temperaturestore');
Route::post('/thermometers/temperaturereport', [ThermometerController::class, 'temperaturereport'])->name('thermometers.temperaturereport');
Route::get('thermometers/graphics/{id}', [ThermometerController::class, 'graphics'])->name('thermometers.graphics');

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::get('/orders/sampling', [OrderController::class, 'sampling'])->name('orders.sampling');
Route::post('/orders/storeSampling', [OrderController::class, 'storeSampling'])->name('orders.storeSampling');
Route::get('/orders/editSampling/{order}', [OrderController::class, 'editSampling'])->name('orders.editSampling');
Route::patch('/orders/updateSampling/{order}', [OrderController::class, 'updateSampling'])->name('orders.updateSampling');
Route::patch('/orders/updateClient/{order}', [OrderController::class, 'updateClient'])->name('orders.updateClient');
Route::delete('/orders/deleteStudy/{id}', [OrderController::class, 'deleteStudy'])->name('orders.deleteStudy');
Route::get('/orders/printOrder/{id}', [OrderController::class, 'printOrder'])->name('orders.printOrder');
Route::get('/orders/printLabels/{id}', [OrderController::class, 'printLabels'])->name('orders.printLabels');

Route::get('/orders/printReports/{id}', [OrderController::class, 'printReports'])->name('orders.printReports');
Route::post('/orders/storeresults/', [OrderController::class, 'storeresults'])->name('orders.storeresults');
Route::get('/orders/showResult/{order_id}/{study_id}/{order_study_id}', [OrderController::class, 'showResult'])->name('orders.showResult');
Route::get('/orders/report/{order_id}/{study_id}/{order_study_id}', [OrderController::class, 'report'])->name('orders.report');
Route::get('/orders/printReport/{order_id}/{study_id}/{order_study_id}', [OrderController::class, 'printReport'])->name('orders.printReport');
Route::get('/orders/printLabel/{order_id}/{study_id}/{order_study_id}', [OrderController::class, 'printLabel'])->name('orders.printLabel');

Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/orders/edit/{order}', [OrderController::class, 'edit'])->name('orders.edit');
Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');

Route::get('/qualities', [QualityController::class, 'index'])->name('qualities.index');
Route::get('/qualities/create', [QualityController::class, 'create'])->name('qualities.create');
Route::post('/qualities', [QualityController::class, 'store'])->name('qualities.store');
Route::get('/qualities/{user}', [QualityController::class, 'show'])->name('qualities.show');
Route::get('/qualities/edit/{user}', [QualityController::class, 'edit'])->name('qualities.edit');
Route::put('/qualities/{user}', [QualityController::class, 'update'])->name('qualities.update');