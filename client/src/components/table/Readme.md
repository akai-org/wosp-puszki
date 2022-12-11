Jak utworzyć nową tabelę ?

1. W pliku np. strony dodajemy

   TableColumns z '@/utils'
   CreateColumns z '@components/table/CreateColumns';
   Table z 'antd';

2. Tworzymy zmienną np. 'columns' przy pomocy funkcji CreateColumns, a jako propsy dajemy nasze ustawienia dla kolumn oraz nasze dane.

  - Ustawienia dla kolumn tworzymy na zasadzie, tabeli która posiada obiekty:
    {
      titleName: '', --- nazwa całej kolumny
      keyName: '', --- klucz który pokrywa sie z nazwą danych które mają sie znajdować w tej kolumnie.
      sortType: '', --- czy ma być opcja sortowania, jeśli tak to jakiego typu ( możliwe opcje to 'number' / 'string' / 'date' )
      search?: boolean; --- czy ma być opcja szukania po tekście ( true / false )
      actions?: []; --- czy ma być kolumna z 'akcjami'. Dodanie tej opcji w nieodpowiednim miejscu (kolumnie w której powinny znajdować się dane)
          Elementy tabeli są obiektami i składają się z :
            title: '' , --- nazwa akcji
            link: '', --- link strony na którą ma przenosić dana akcja --- ta funkcjonalność jest do przebudowania w zależności jakie będzie zapotrzebowanie
            color: '', --- color danej akcji, może zostać wpisana nazwa np. 'blue' / 'red' albo kolor w postaci hex np. '#fff'
    }

3.  Dodajemy komponent Table do naszego DOMu z wybranymi parametrami np.

          <Table
            size="small"   -- rozmiar komórek ( głównie wysokość )
            bordered={true} -- wiersze i kolumny odzielone linią
            columns={columns} --- nasze wygenerowane kolumny
            pagination={false} -- czy chcemy by tabela miała strony
            dataSource={data} --- nasze dane
            tableLayout="fixed" -- aby tabela byłą responsywna
            scroll={{ y: '65vh' }} -- nagłówki kolumn zawsze będą na górze, trzeba ustawić wysokość całej tabeli.
          />
