OC.L10N.register(
    "updatenotification",
    {
    "{version} is available. Get more information on how to update." : "Доступна версия {version}. Получить дополнительную информацию о способе обновления.",
    "Channel updated" : "Канал обновлён",
    "Web updater is disabled" : "Веб обновление отключено",
    "Update notifications" : "Уведомления об обновлениях",
    "The update server could not be reached since %d days to check for new updates." : "Сервер обновлений недоступен для проверки наличия обновлений дней: %d.",
    "Please check the Nextcloud and server log files for errors." : "Проверьте наличие ошибок в файлах журналов Nextcloud и сервера.",
    "Update to %1$s is available." : "Доступно обновление до версии %1$s.",
    "Update for %1$s to version %2$s is available." : "Для приложения %1$s доступно обновление до версии %2$s.",
    "Update for {app} to version %s is available." : "Для приложения {app} доступно обновление до версии %s.",
    "Update notification" : "Уведомление об обновлении",
    "Displays update notifications for Nextcloud and provides the SSO for the updater." : "Показывает уведомления об обновлениях для Nextcloud и обеспечивает систему обновления технологией единого входа (SSO).",
    "Update" : "Обновить",
    "The version you are running is not maintained anymore. Please make sure to update to a supported version as soon as possible." : "Версия, которой вы пользуетесь, больше не обслуживается. Пожалуйста, обновитесь до поддерживаемой версии как можно скорее.",
    "Apps missing compatible version" : "Приложения без совместимой версии",
    "View in store" : "Перейти в магазин приложений",
    "Apps with compatible version" : "Приложения с совместимой версией",
    "Please note that the web updater is not recommended with more than 100 users! Please use the command line updater instead!" : "Обратите внимание, что установка обновления с использованием веб-интерфейса не рекомендуется при наличии более ста пользователей. В таком случае желательно использовать обновление с использованием командной строки.",
    "Open updater" : "Открыть окно обновления",
    "Download now" : "Скачать сейчас",
    "Please use the command line updater to update." : "Для обновления воспользуйтесь инструментом для командной строки.",
    "What's new?" : "Что нового?",
    "The update check is not yet finished. Please refresh the page." : "Проверка обновлений ещё не закончена. Пожалуйста обновите страницу.",
    "Your version is up to date." : "Версия не требует обновления.",
    "A non-default update server is in use to be checked for updates:" : "Не сервер по умолчанию используется как сервер для проверки обновлений:",
    "You can change the update channel below which also affects the apps management page. E.g. after switching to the beta channel, beta app updates will be offered to you in the apps management page." : "Изменение канала обновлений также влияет на установку обновлений приложений: при использовании канала бета-версии Nextcloud для используемых приложений также будут предлагаться бета-версии.",
    "Update channel:" : "Канал обновлений:",
    "You can always update to a newer version. But you can never downgrade to a more stable version." : "Вы всегда можете обновиться до более новой версии. Но учтите, что вы не сможете откатиться до более стабильной версии.",
    "Notify members of the following groups about available updates:" : "Уведомлять о наличии обновлений участников следующих групп:",
    "Only notifications for app updates are available." : "Доступны только уведомления об обновлениях приложений.",
    "The selected update channel makes dedicated notifications for the server obsolete." : "Выбранный канал обновлений высылает специальные уведомления, если сервер устарел.",
    "The selected update channel does not support updates of the server." : "Выбранный канал обновлений не поддерживает обновление сервера.",
    "A new version is available: <strong>{newVersionString}</strong>" : "Доступна новая версия: <strong>{newVersionString}</strong> ",
    "Note that after a new release the update only shows up after the first minor release or later. We roll out new versions spread out over time to our users and sometimes skip a version when issues are found. Learn more about updates and release channels at {link}" : "Обратите внимание, что уведомление  о возможности обновления до новой значительной версии будет показано только после выхода этой версии с первым набором исправлений или позже. Процесс распространения новых версий растягивается во времени, и некоторые версии уведомление о выпуске некоторых версий может быть не показано в случае, если в ней были обнаружены ошибки. Дополнительные сведения о выпуске обновлений и видах каналов приведены на соответствующей странице: {link}.",
    "Checked on {lastCheckedDate}" : "Проверено {lastCheckedDate}",
    "Checking apps for compatible versions" : "Проверка приложений на совместимость версий",
    "Please make sure your config.php does not set <samp>appstoreenabled</samp> to false." : "Убедитесь, что значением параметра <samp>appstoreenabled</samp> в файле «config.php» не является «false».",
    "Could not connect to the App Store or no updates have been returned at all. Search manually for updates or make sure your server has access to the internet and can connect to the App Store." : "Не удалось подключиться к App Store или обновления не были получены. Выполните поиск обновлений вручную или убедитесь, что ваш сервер имеет доступ к Интернету и может подключиться к App Store.",
    "<strong>All</strong> apps have a compatible version for this Nextcloud version available." : "<strong>Все</strong> приложения имеют версию, совместимую с этой версией Nextcloud.",
    "View changelog" : "Просмотреть изменения",
    "Enterprise" : "Использование на предприятии (Enterprise)",
    "For enterprise use. Provides always the latest patch level, but will not update to the next major release immediately. That update happens once Nextcloud GmbH has done additional hardening and testing for large-scale and mission-critical deployments. This channel is only available to customers and provides the Nextcloud Enterprise package." : "Для корпоративного использования. Всегда обеспечивает самый последний уровень исправлений, но не будет немедленно обновляться до следующего основного выпуска. Обновление произойдет, когда Nextcloud GmbH проведут дополнительное тестирование для крупномасштабных и критически важных развертываний. Этот канал доступен только для клиентов и предоставляет пакет Nextcloud Enterprise.",
    "Stable" : "Стабильные выпуски (Stable)",
    "The most recent stable version. It is suited for regular use and will always update to the latest major version." : "Актуальная стабильная версия. Подходит для обычного использования и будет обновляться до старшей версии сразу после её выхода.",
    "Beta" : "Бета-версии (Beta)",
    "A pre-release version only for testing new features, not for production environments." : "Предрелизная версия, предназначенная только для тестирования новых возможностей.",
    "_<strong>%n</strong> app has no compatible version for this Nextcloud version available._::_<strong>%n</strong> apps have no compatible version for this Nextcloud version available._" : ["У <strong>%n</strong> приложения нет версии, совместимой с этой версией Nextcloud.","У <strong>%n</strong> приложений нет версии, совместимой с этой версией Nextcloud.","У <strong>%n</strong> приложений нет версии, совместимой с этой версией Nextcloud.","У <strong>%n</strong> приложений нет версии, совместимой с этой версией Nextcloud."],
    "<strong>All</strong> apps have a compatible version for this Nextcloud version available" : "<strong>Все</strong> приложения имеют версию, совместимую с этой версией Nextcloud.",
    "_<strong>%n</strong> app has no compatible version for this Nextcloud version available_::_<strong>%n</strong> apps have no compatible version for this Nextcloud version available_" : ["У <strong>%n</strong> приложения нет версии, совместимой с этой версией Nextcloud.","У <strong>%n</strong> приложений нет версии, совместимой с этой версией Nextcloud.","У <strong>%n</strong> приложений нет версии, совместимой с этой версией Nextcloud.","У <strong>%n</strong> приложений нет версии, совместимой с этой версией Nextcloud."]
},
"nplurals=4; plural=(n%10==1 && n%100!=11 ? 0 : n%10>=2 && n%10<=4 && (n%100<12 || n%100>14) ? 1 : n%10==0 || (n%10>=5 && n%10<=9) || (n%100>=11 && n%100<=14)? 2 : 3);");