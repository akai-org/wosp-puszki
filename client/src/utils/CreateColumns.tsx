// Jak utworzyć nową tabelę ?

// 1. Do prawidłowego działania potrzebujemy

//    typ TableColumns z '@/utils'
//    CreateColumns z '@components/table/CreateColumns';
//    Table z 'antd';

// 2. Tworzymy zmienną np. 'columns' o type TableColumns[] przy pomocy funkcji CreateColumns, a jako propsy dajemy nasze ustawienia dla kolumn oraz nasze dane.

//   - Ustawienia dla kolumn są tabelą obiektów ( każdy obiekt to następna kolumna ):
//     {
//       titleName: '',            --- nazwa całej kolumny
//       keyName: '',              --- klucz który pokrywa sie z nazwą danych które mają być wyświetlane w danej kolumnie.
//       sortType?: '',            --- czy ma być opcja sortowania, jeśli tak to jakiego typu ( możliwe opcje to 'number' / 'string' / 'date' )
//       search?: boolean;         --- czy ma być opcja szukania po tekście ( true / false )
//       actions?: [];             --- czy ma być kolumna z 'akcjami' czyli funkcjami dla danego elementu.
//           Elementy tabeli są obiektami i składają się z :
//             title: '' ,         --- tekst wyświetlany
//             link: '',           --- link strony na którą ma przenosić dana akcja --- ta funkcjonalność jest do przebudowania w zależności jakie będzie zapotrzebowanie w przyszłości
//             color: '',          --- możliwość ustawienia wybranego koloru dla tekstu, może zostać wpisana nazwa np. 'blue' / 'red' albo kolor w postaci hex np. '#fff'
//       fixed?: 'left' | 'right'  --- 'przypina' daną kolumnę do wybranej strony
//       width?: number            --- ustawia szerokość danej kolumny, należy użyć tej opcji podczas używania funkcji 'fixed' aby prawidłowo działało
//       beforeText?: '',          --- Dodajemy w ten sposób string przed daną wartością.
//       afterText?: '',           --- Dodajemy w ten sposób string po danej wartości. Przydatne w przypadku walut.
//       status?: {                --- Gdy chcemy aby w danej kolumnie został wyświetlany status w postaci Taga
//         key: string;            --- Klucz danych które mają być sprawdzana
//         options: {              --- Potrzebne opcje
//           on: {
//                value: string | number | boolean;               --- Wartość danych dla pozycji właściwej
//                description: string };                          --- Zawartość Taga
//           off: {
//                value: string | number | boolean;               --- Wartość danych dla pozycji nie właściwej
//                description: string };                          --- Zawartość Taga
//         };
//       };
//     }

//         NIE NALEŻY MIESZAĆ ZE SOBĄ OPCJI AFTERTEXT CZY BEFORETEXT Z STATUSEM LUB ACTIONS, w ten sposób mogą wystąpić niepożądane skutki i dane będą wyświetlane w nieprawidłowy sposób

// 3.  Dodajemy komponent Table do naszego DOMu i załączamy utworzone 'columns' do niego, wraz z wybranymi parametrami np.

//       <Table
//         size="middle"                 --- rozmiar komórek ( głównie wysokość )
//         columns={columns}            --- nasze wygenerowane kolumny
//         pagination={false}           --- czy chcemy by tabela miała strony
//         dataSource={data}            --- nasze dane
//         scroll={{ y: '65vh' }}       --- nagłówki kolumn zawsze będą na górze, trzeba ustawić wysokość całej tabeli, w tym przypadku 65vh.
//         rowClassName={s.table_row}   --- Dodaje klasę stylu do każdego wiersza
//       />

// Types
import type { InputRef } from 'antd';
import type { ColumnType } from 'antd/es/table';
import type { FilterConfirmProps } from 'antd/es/table/interface';
import type { TableColumns } from '@/utils';

// Ant design
import { Space, Button, Input, Tag } from 'antd';
import { SearchOutlined } from '@ant-design/icons';

// React
import React from 'react';
import { useRef, useState } from 'react';
import Highlighter from 'react-highlight-words';

export function CreateColumns<DataType extends { [key: string]: string | number }>(
  columnsOptions: TableColumns[],
  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  _data: DataType[],
) {
  const [searchText, setSearchText] = useState('');
  const [searchedColumn, setSearchedColumn] = useState('');
  const searchInput = useRef<InputRef>(null);

  // Do przebudowania w przyszłości, zależny od zapotrzebowania w przyszłości
  const renderActions = (actions?: TableColumns['actions']) => {
    if (!actions || actions.length === 0) return;
    return {
      render: (_: unknown, record: DataType) => (
        <Space size="middle">
          {actions.map((action) => {
            return (
              <a
                style={{ color: action.color }}
                key={action.title}
                href={action.link ? `${action.link}${record.key}` : '#'}
              >
                {action.title}
              </a>
            );
          })}
        </Space>
      ),
    };
  };

  // Dodanie opcji sortującej dla danych w kolumnie
  const getSorter = (sortType: TableColumns['sortType'], keyName: string) => {
    const collator = new Intl.Collator();
    if (!sortType) return {};

    // Wybór prawidłowego sposobu sportowania danych
    if (sortType === 'string') {
      return {
        sorter: {
          compare: (a: DataType, b: DataType) =>
            collator.compare(
              a[keyName as keyof DataType] as string,
              b[keyName as keyof DataType] as string,
            ),
        },
      };
    } else if (sortType === 'number') {
      return {
        sorter: {
          compare: (a: DataType, b: DataType) =>
            (a[keyName as keyof DataType] as number) -
            (b[keyName as keyof DataType] as number),
        },
      };
    } else if (sortType === 'date') {
      return {
        sorter: {
          compare: (a: DataType, b: DataType) =>
            Date.parse(a[keyName as keyof DataType] as string) -
            Date.parse(b[keyName as keyof DataType] as string),
        },
      };
    }
  };

  // Dodanie opcji fixed dla kolumny
  const getFixed = (fixed: 'left' | 'right' | undefined, width: number | undefined) => {
    if (!fixed) return {};
    return { fixed: fixed, width: width ? width : undefined };
  };

  // Dodanie opcji wyszukiwarki dla danych w kolumnie
  const getColumnSearchProps = (
    dataIndex: string,
    search: boolean | undefined,
  ): ColumnType<DataType> => {
    if (!search) return {};

    const handleSearch = (
      selectedKeys: string[],
      confirm: (param?: FilterConfirmProps) => void,
      dataIndex: string,
    ) => {
      confirm();
      setSearchText(selectedKeys[0]);
      setSearchedColumn(dataIndex);
    };

    const handleReset = (clearFilters: () => void) => {
      clearFilters();
      setSearchText('');
    };

    return {
      filterDropdown: ({
        setSelectedKeys,
        selectedKeys,
        confirm,
        clearFilters,
        close,
      }) => (
        <Space
          size="small"
          direction="vertical"
          style={{
            padding: '0.5rem',
            backgroundColor: '#003541',
            borderRadius: '0.5rem',
          }}
        >
          <Input
            ref={searchInput}
            placeholder={`Search ${dataIndex}`}
            value={selectedKeys[0]}
            onChange={(e) => setSelectedKeys(e.target.value ? [e.target.value] : [])}
            onPressEnter={() =>
              handleSearch(selectedKeys as string[], confirm, dataIndex)
            }
            style={{ marginBottom: 8, display: 'block' }}
          />
          <Space size="middle">
            <Button
              type="primary"
              onClick={() => handleSearch(selectedKeys as string[], confirm, dataIndex)}
              icon={<SearchOutlined />}
              style={{ width: 120 }}
            >
              Search
            </Button>
            <Button
              onClick={() => clearFilters && handleReset(clearFilters)}
              style={{ width: 90 }}
            >
              Reset
            </Button>
            <Button
              type="link"
              style={{ color: '#fff' }}
              onClick={() => {
                confirm({ closeDropdown: false });
                setSearchText((selectedKeys as string[])[0]);
                setSearchedColumn(dataIndex);
              }}
            >
              Filter
            </Button>
            <Button type="link" style={{ color: '#fff' }} onClick={close}>
              close
            </Button>
          </Space>
        </Space>
      ),
      filterIcon: (filtered: boolean) => (
        <SearchOutlined style={{ color: filtered ? '#1890ff' : undefined }} />
      ),
      onFilter: (value, record: DataType) =>
        record[dataIndex]
          .toString()
          .toLowerCase()
          .includes((value as string).toLowerCase()),
      onFilterDropdownOpenChange: (visible) => {
        if (visible) {
          searchInput.current?.select();
        }
      },
      render: (text) =>
        searchedColumn === dataIndex ? (
          <Highlighter
            highlightStyle={{ backgroundColor: '#ffc069', padding: 0 }}
            searchWords={[searchText]}
            autoEscape
            textToHighlight={text ? text.toString() : ''}
          />
        ) : (
          text
        ),
    };
  };

  // Dodanie prefixów i suffixów
  const renderText = (
    keyName: string,
    beforeText: string | undefined,
    afterText: string | undefined,
  ): object => {
    if (!beforeText && !afterText) return {};

    return {
      render: (item: unknown, record: DataType) => (
        <Space align="center" size="large">
          <div>
            {beforeText} {record[keyName]} {afterText}
          </div>
        </Space>
      ),
    };
  };

  // Wyświetlanie tagów statusowych
  const setStatus = (
    status:
      | {
          key: string;
          options: {
            on: { value: string | number | boolean; description: string };
            off: { value: string | number | boolean; description: string };
          };
        }
      | undefined,
  ) => {
    if (!status || !status.key || !status.options) return {};
    return {
      render: (item: unknown, record: DataType) => {
        let color = '#707070';
        if (record[status.key] === status.options.on.value) {
          color = '#429445';
        } else if (record[status.key] === status.options.off.value) {
          color = '#f5222d';
        }
        return (
          <Tag color={color} key={record[status.key]}>
            {record[status.key]
              ? status.options.on.description
              : status.options.off.description}
          </Tag>
        );
      },
    };
  };

  // Tworzenie i sklejanie wszystkich ustawień dla kolumn
  return columnsOptions.map((column) => {
    return {
      title: column.titleName,
      dataIndex: column.keyName,
      key: column.keyName,
      width: column.width,
      ...setStatus(column.status),
      ...getColumnSearchProps(column.keyName, column.search),
      ...getSorter(column.sortType, column.keyName),
      ...renderActions(column.actions),
      ...getFixed(column.fixed, column.width),
      ...renderText(column.keyName, column.beforeText, column.afterText),
    };
  });
}
