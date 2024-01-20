## Workflow of Charity Box process

API umożliwia wydanie i rozliczenie puszki.

<span style="color: green">!!! Dokładna budowa endpointów i ich działanie dostępna jest pod:</span>
```php
http://localhost:8000/api/documentation
```

### Wydanie puszki
Na początku finału wolontariusz zgłasza się do sztabu, gdzie jest mu wydawana puszka z identyfikatorem.

Wydanie puszki polega na wpisaniu numeru wolontariusza i kliknięciu "Wydaj puszkę".

**UWAGA**: `id` puszki jest używane tylko wewnętrznie, do wyświetlania używamy `identifier` wolontariusza.

**Operacja API**: `POST  /api/collectors/{collectorIdentifier}/box/create`

**Możliwe błędy**: 

1. Puszka może być wydana wielokrotnie w ciągu dnia (np. wolontariusz ją zapełnił, ale idzie dalej zbierać),
albo wielokrotnie na początku dnia, np. zbiórka stacjonarna skłąda się z 10 puszek, więc operacja wydawania jest
wykonywana 10 razy.

### Rozliczenie puszki po zbieraniu

Po powrocie z kwesty wolontariusz siada do stanowiska rozliczeniowego.
Po kolei:
1. Puszka jest znajdowana w systemie poprzez identyfikator wolontariusza

    **Endpoint**: `GET api/collectors/{collectorIdentifier}/box/latestUncounted`


2. Potwierdzane są dane i sygnalizowane jest rozpoczęcie liczenia

   **Endpoint**: `POST api/charityBoxes/{id}/startCounting`


3. Wysyłane są dane dot. zawartości puszki

    **Endpoint**: `PUT api/charityBoxes/{id}`


4. Pokazywany jest ekran potwierdzenia, i po zatwierdzeniu wysyłane kolejne potwierdzenie

    **Endpoint**: `POST api/charityBoxes/{id}/finishCounting`


5. Wolontariusz udaje się do koordynatora rozliczenia.


6. Ten wypisuje dokumenty i ostatecznie satwierdza puszkę w systemie

    **Endpoint**: `TODO endpoint`

Zwrotką jest obiekt **charity box** jak przy found.