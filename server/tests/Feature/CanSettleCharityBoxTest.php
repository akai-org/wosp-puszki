<?php

use App\CharityBox;
use App\Collector;
use App\User;

beforeEach(function () {
    $this->coordinator = User::with('roles')->orderBy('id')->whereRelation('roles', 'name', 'collectorcoordinator')->first();
    $this->volounteer = User::with('roles')->orderBy('id')->whereRelation('roles', 'name', 'volounteer')->first();
    $this->assertEquals($this->coordinator->name, 'wolokord');
    $this->assertEquals($this->volounteer->name, 'wosp01');
});

test('as a volounteer coordinator I can give out a box', function () {
    $this->actingAs($this->coordinator);

    $this->collector = Collector::orderBy('id', 'asc')->first();

    $response = $this->get('/liczymy/box/create');

    $response->assertStatus(200);

    $response->assertSeeInOrder([
        'Wydawanie puszki',
        'Numer identyfikatora',
        'Dodaj puszkę',
    ]);

    $response = $this->followingRedirects()->post('liczymy/box/create', [
        'collectorIdentifier' => $this->collector->identifier,
    ]);

    $response->assertStatus(200);

    $this->assertDatabaseHas('charity_boxes', [
        'collectorIdentifier' => $this->collector->identifier,
        'collector_id' => $this->collector->id,
        'is_given_to_collector' => 1,
        'given_to_collector_user_id' => $this->coordinator->id,
        'is_counted' => 0,
        'is_confirmed' => 0,
        'time_confirmed' => null,
    ]);

    $this->box = CharityBox::where('collectorIdentifier', '=', $this->collector->identifier)->orderBy('created_at', 'desc')->first();

});

test('as a volounteer I can settle a charity box', function () {
    $this->actingAs($this->volounteer);

    $this->collector = Collector::orderBy('id', 'asc')->first();
    $this->box = CharityBox::where('collectorIdentifier', '=', $this->collector->identifier)->orderBy('created_at', 'desc')->first();

    // Wchodzę na rozliczanie puszki
    $response = $this->get('/liczymy/box/find');

    // Widzę formularz
    $response->assertSeeInOrder([
        'Znajdź puszkę do rozliczenia',
        'Numer identyfikatora',
        'Z puszki (przed ukośnikiem)',
        'Wyszukaj puszkę',
        'Wyszukaj puszkę',
    ]);

    // Wpisuję identyfikator
    $response = $this->followingRedirects()->post('/liczymy/box/find', [
        'collectorIdentifier' => $this->collector->identifier,
    ]);

    $response->assertStatus(200);
    // Widzę dane puszki
    $response->assertSeeInOrder([
        'Znaleziono puszkę '.$this->box->id,
        'Wolontariusz',
        $this->collector->firstName.' '.$this->collector->lastName,
        'Numer identyfikatora i na puszce',
        $this->collector->identifier,
        'Potwierdź, że dane z puszki i identyfikatora są zgodne z wyświetlonymi.',
        'Potwierdź, że puszka nie nosi śladów uszkodzeń.',
        'Nie oddawaj rozliczonej puszki wolontariuszowi.',
        'Zgodność z danymi rzeczywistymi',
        'Potwierdzam',
    ]);

    // Potwierdzam
    $response = $this->followingRedirects()->post('/liczymy/box/findConfirm', [
        'boxID' => $this->box->id,
    ]);

    $response->assertStatus(200);
    $response->assertSeeInOrder([
        'Rozliczenie puszki wolontariusza '.$this->collector->firstName.' '.$this->collector->lastName,
        'Nominał',
        'Potwierdzam poprawność danych',
        'Rozlicz puszkę',
    ]);

    // Wypełniam ilości monet i wysyłam

    $fields = [
        'count_1gr' => 1,
        'count_2gr' => 1,
        'count_5gr' => 1,
        'count_10gr' => 1,
        'count_20gr' => 1,
        'count_50gr' => 1,
        'count_1zl' => 0,
        'count_2zl' => 0,
        'count_5zl' => 0,
        'count_10zl' => 0,
        'count_20zl' => 0,
        'count_50zl' => 0,
        'count_100zl' => 0,
        'count_200zl' => 0,
        'count_500zl' => 0,
        'amount_EUR' => 0,
        'amount_GBP' => 0,
        'amount_USD' => 0,
        'comment' => '',
        'additional_comment' => '',
    ];

    $response = $this->followingRedirects()->post('/liczymy/box/count/'.$this->box->id, array_merge(
        $fields,
        [
            'prevent-enter' => 'xxxx',
        ]
    ));

    $response->assertStatus(200);

    // Potwierdzam
    $response = $this->followingRedirects()->post('/liczymy/box/count/'.$this->box->id.'/confirm');

    // Widzę w bazie ze jest dodane i zatwierdzone
    $this->assertDatabaseHas('charity_boxes', array_merge(
        $fields,
        [
            'collectorIdentifier' => $this->collector->identifier,
            'collector_id' => $this->collector->id,
            'is_given_to_collector' => 1,
            'given_to_collector_user_id' => $this->coordinator->id,
            'is_counted' => 1,
            'is_confirmed' => 0,
            'counting_user_id' => $this->volounteer->id,
            'user_confirmed_id' => null,
            'time_confirmed' => null,
            'count_1gr' => 1,
            'count_2gr' => 1,
            'count_5gr' => 1,
            'count_10gr' => 1,
            'count_20gr' => 1,
            'count_50gr' => 1,
            'count_1zl' => 0,
            'count_2zl' => 0,
            'count_5zl' => 0,
            'count_10zl' => 0,
            'count_20zl' => 0,
            'count_50zl' => 0,
            'count_100zl' => 0,
            'count_200zl' => 0,
            'count_500zl' => 0,
            'amount_PLN' => '0.88',
            'amount_EUR' => '0.00',
            'amount_USD' => '0.00',
            'amount_GBP' => '0.00',
            'comment' => null,
            'additional_comment' => null,
            'is_special_box' => 0,
        ]
    ));

    $response->assertStatus(200);

    // Cleanup to be refactored
    $this->box->delete();
});
