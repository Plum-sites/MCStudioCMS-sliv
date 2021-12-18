<?php

// Auth Routes
Auth::routes();

// Frontend Routes
Route::get('/', 'Frontend\FrontendController@dashboard')->name('dashboard');
Route::get('/404', 'Frontend\FrontendController@dashboard')->name('404');
Route::get('/#block', 'Frontend\FrontendController@dashboard')->name('blocked');
Route::get('/#login', 'Frontend\FrontendController@dashboard')->name('login');

Route::post('forgot/password', 'Frontend\FrontendController@forgotPass')->name('forgot.pass');
Route::get('reset/{token}', 'Frontend\FrontendController@resetLink')->name('reset.passlink');
Route::post('reset/password', 'Frontend\FrontendController@passwordReset')->name('reset.pass');
Route::post('reset/cabinet', 'Frontend\FrontendController@passwordResetCabinet')->name('reset.pass.cabinet');

Route::get('/login/vk/link', 'Frontend\FrontendController@redirectVkAuth')->name('login.vk.link');
Route::post('/login/vk/link', 'Frontend\FrontendController@redirectVkAuth')->name('login.vk.link');
Route::get('/login/vk/bind', 'Frontend\FrontendController@redirectVkAuth')->name('login.vk.bind');
Route::post('/login/vk/bind', 'Frontend\FrontendController@redirectVkAuth')->name('login.vk.bind');
Route::get('/login/vk/auth', 'Frontend\FrontendController@dashboard')->name('login.vk.auth');
Route::post('/login/vk/auth', 'Frontend\FrontendController@dashboard')->name('login.vk.auth');

Route::get('/balance/get', 'Frontend\FrontendController@balanceGet')->name('balance.get');
Route::post('/balance/get', 'Frontend\FrontendController@balanceGet')->name('balance.get');
Route::get('/balance/payment', 'Frontend\FrontendController@balancePayment')->name('balance.payment');
Route::post('/balance/payment', 'Frontend\FrontendController@balancePayment')->name('balance.payment');
Route::get('/balance/exchange', 'Frontend\FrontendController@balanceExchange')->name('balance.exchange');
Route::post('/balance/exchange', 'Frontend\FrontendController@balanceExchange')->name('balance.exchange');

Route::get('/rules', 'Frontend\FrontendController@rules')->name('rules');

Route::get('/start', 'Frontend\FrontendController@start')->name('start');

Route::get('/donate', 'Frontend\FrontendController@donate')->name('donate');

Route::get('/storets', 'Frontend\FrontendController@storets')->name('storets');
Route::post('/storets/load', 'Frontend\FrontendController@storetsLoad')->name('storets.load');
Route::post('/storets/buys', 'Frontend\FrontendController@storetsBuys')->name('storets.buys');
Route::get('/storets/{server_id}', 'Frontend\FrontendController@storetsServer')->name('storets.server');

Route::get('/banlist', 'Frontend\FrontendController@banlist')->name('banlist');
Route::post('/banlist', 'Frontend\FrontendController@banlist')->name('banlist.list');

Route::get('/ratings', 'Frontend\FrontendController@ratings')->name('ratings');
Route::post('/ratings/exchange', 'Frontend\FrontendController@ratingsExchange')->name('ratings.exchange');
Route::get('/ratings/{name}', 'VotesController@service')->name('ratings.service');
Route::post('/ratings/{name}', 'VotesController@service')->name('ratings.service');

Route::get('/cabinet', 'Frontend\FrontendController@cabinet')->name('cabinet');
Route::post('/cabinet/upload/skin', 'Frontend\FrontendController@cabinetUploadSkin')->name('cabinet.upload.skin');
Route::post('/cabinet/upload/cloak', 'Frontend\FrontendController@cabinetUploadCloak')->name('cabinet.upload.cloak');
Route::post('/cabinet/privileges/list', 'Frontend\FrontendController@cabinetPrivilegesList')->name('cabinet.privileges.list');
Route::post('/cabinet/privileges/buys', 'Frontend\FrontendController@cabinetPrivilegesBuys')->name('cabinet.privileges.buys');
Route::post('/cabinet/kits/list', 'Frontend\FrontendController@cabinetKitsList')->name('cabinet.kits.list');
Route::post('/cabinet/kits/buys', 'Frontend\FrontendController@cabinetKitsBuys')->name('cabinet.kits.buys');
Route::post('/cabinet/prefix/list', 'Frontend\FrontendController@cabinetPrefixList')->name('cabinet.prefix.list');
Route::post('/cabinet/prefix/save', 'Frontend\FrontendController@cabinetPrefixSave')->name('cabinet.prefix.save');

// Cron Routes
Route::get('cron/news', 'CronController@news')->name('cron.news');
Route::get('cron/ratings', 'CronController@ratings')->name('cron.ratings');
Route::get('cron/monitoring', 'CronController@monitoring')->name('cron.monitoring');
Route::get('cron/privileges', 'CronController@privileges')->name('cron.privileges');
// Tools Routes
Route::get('tools/ip', 'ToolsController@getIp');
Route::get('tools/browser', 'ToolsController@getBrowser');
Route::get('tools/sessions', 'ToolsController@getSessions');
//Payment handler
Route::get('payments/{name}', 'Frontend\FrontendController@paymentshandler');
Route::post('payments/{name}', 'Frontend\FrontendController@paymentshandler');

Route::get('captcha/image', 'CaptchaController@getKeyString')->name('captcha.image');

// Admin Routes
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'Admin\LoginController@showLoginForm')->middleware('guest:admin')->name('admin');
    Route::post('login', 'Admin\LoginController@login')->name('admin.login');
    Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('dashboard', 'Admin\AdminController@dashboard')->name('admin.dashboard');

        Route::get('serversList', 'Admin\AdminController@serversList')->name('admin.serversList');
        Route::post('serversList', 'Admin\AdminController@serversList')->name('admin.serversList.info');
        Route::post('serversList/adds', 'Admin\AdminController@serversListAdds')->name('admin.serversList.adds');
        Route::post('serversList/save', 'Admin\AdminController@serversListSave')->name('admin.serversList.save');
        Route::post('serversList/dels', 'Admin\AdminController@serversListDels')->name('admin.serversList.dels');

        Route::get('categorysList', 'Admin\AdminController@categorysList')->name('admin.categorysList');
        Route::post('categorysList', 'Admin\AdminController@categorysList')->name('admin.categorysList.info');
        Route::post('categorysList/adds', 'Admin\AdminController@categorysListAdds')->name('admin.categorysList.adds');
        Route::post('categorysList/save', 'Admin\AdminController@categorysListSave')->name('admin.categorysList.save');
        Route::post('categorysList/dels', 'Admin\AdminController@categorysListDels')->name('admin.categorysList.dels');

        Route::get('itemsList', 'Admin\AdminController@itemsList')->name('admin.itemsList');
        Route::post('itemsList', 'Admin\AdminController@itemsList')->name('admin.itemsList.info');
        Route::post('itemsList/load', 'Admin\AdminController@itemsListLoad')->name('admin.itemsList.load');
        Route::post('itemsList/adds', 'Admin\AdminController@itemsListAdds')->name('admin.itemsList.adds');
        Route::post('itemsList/save', 'Admin\AdminController@itemsListSave')->name('admin.itemsList.save');
        Route::post('itemsList/dels', 'Admin\AdminController@itemsListDels')->name('admin.itemsList.dels');

        Route::get('privilegesList', 'Admin\AdminController@privilegesList')->name('admin.privilegesList');
        Route::post('privilegesList', 'Admin\AdminController@privilegesList')->name('admin.privilegesList.info');
        Route::post('privilegesList/load', 'Admin\AdminController@privilegesListLoad')->name('admin.privilegesList.load');
        Route::post('privilegesList/adds', 'Admin\AdminController@privilegesListAdds')->name('admin.privilegesList.adds');
        Route::post('privilegesList/save', 'Admin\AdminController@privilegesListSave')->name('admin.privilegesList.save');
        Route::post('privilegesList/dels', 'Admin\AdminController@privilegesListDels')->name('admin.privilegesList.dels');

        Route::get('kitsList', 'Admin\AdminController@kitsList')->name('admin.kitsList');
        Route::post('kitsList', 'Admin\AdminController@kitsList')->name('admin.kitsList.info');
        Route::post('kitsList/load', 'Admin\AdminController@kitsListLoad')->name('admin.kitsList.load');
        Route::post('kitsList/adds', 'Admin\AdminController@kitsListAdds')->name('admin.kitsList.adds');
        Route::post('kitsList/save', 'Admin\AdminController@kitsListSave')->name('admin.kitsList.save');
        Route::post('kitsList/dels', 'Admin\AdminController@kitsListDels')->name('admin.kitsList.dels');

        Route::get('usersList', 'Admin\AdminController@usersList')->name('admin.usersList');
        Route::post('usersList', 'Admin\AdminController@usersList')->name('admin.usersList.info');
        Route::post('usersList/adds', 'Admin\AdminController@usersListAdds')->name('admin.usersList.adds');
        Route::get('usersList/{user}', 'Admin\AdminController@usersListUser')->name('admin.usersList.user');
        Route::post('usersList/logout', 'Admin\AdminController@usersListUserLogout')->name('admin.usersList.user.logout');
        Route::post('usersList/view/{id}', 'Admin\AdminController@usersListUserView')->name('admin.usersList.user.view');
        Route::post('usersList/update/{id}', 'Admin\AdminController@usersListUserUpdate')->name('admin.usersList.user.update');
        Route::get('usersList/notify/{id}', 'Admin\AdminController@usersListNotify')->name('admin.usersList.notify');
        Route::post('usersList/notify/info', 'Admin\AdminController@usersListNotifyInfo')->name('admin.usersList.notify.info');
        Route::post('usersList/notify/send', 'Admin\AdminController@usersListNotifySend')->name('admin.usersList.notify.send');
        Route::get('usersList/price/{uid}', 'Admin\AdminController@usersListPrice')->name('admin.usersList.price');
        Route::post('usersList/price/update/{uid}', 'Admin\AdminController@usersListPriceUpdate')->name('admin.usersList.price.update');
        Route::post('usersList/password/{id}', 'Admin\AdminController@userPasschange')->name('admin.usersList.password.change');

        Route::get('settingList', 'Admin\AdminController@settingList')->name('admin.settingList');
        Route::post('settingList', 'Admin\AdminController@settingList')->name('admin.settingList.info');
        Route::post('settingList/save', 'Admin\AdminController@settingListSave')->name('admin.settingList.save');

        Route::get('smtp', 'Admin\AdminController@smtp')->name('admin.smtp');
        Route::post('smtp', 'Admin\AdminController@smtp')->name('admin.smtp.info');
        Route::post('smtp/save', 'Admin\AdminController@smtpSave')->name('admin.smtp.save');

        // Система промокодов
        Route::get('promosList', 'Admin\AdminController@promosList')->name('admin.promosList');
        Route::post('promosList', 'Admin\AdminController@promosList')->name('admin.promosList.info');
        Route::post('promosList/load', 'Admin\AdminController@promosListLoad')->name('admin.promosList.load');
        Route::post('promosList/adds', 'Admin\AdminController@promosListAdds')->name('admin.promosList.adds');
        Route::post('promosList/save', 'Admin\AdminController@promosListSave')->name('admin.promosList.save');
        Route::post('promosList/dels', 'Admin\AdminController@promosListDels')->name('admin.promosList.dels');
        Route::post('promos/check', 'Frontend\FrontendController@promosCheck')->name('promo.check');

        Route::get('ratingsList', 'Admin\AdminController@ratingsList')->name('admin.ratingsList');
        Route::post('ratingsList', 'Admin\AdminController@ratingsList')->name('admin.ratingsList.info');
        Route::post('ratingsList/save', 'Admin\AdminController@ratingsListSave')->name('admin.ratingsList.save');

        Route::get('gatewaysList', 'Admin\AdminController@gatewaysList')->name('admin.gatewaysList');
        Route::post('gatewaysList', 'Admin\AdminController@gatewaysList')->name('admin.gatewaysList.info');
        Route::post('gatewaysList/save', 'Admin\AdminController@gatewaysListSave')->name('admin.gatewaysList.save');

    });
});