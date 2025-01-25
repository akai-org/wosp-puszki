// Jak utworzyć nową tabelę ?

// 1. Do prawidłowego działania potrzebujemy

//    typ TableColumns z '@/utils'
//    CreateColumns z '@components/table/CreateColumns';
//    Table z 'antd';

// 2. Tworzymy zmienną np. 'columns' o type TableColumns[] przy pomocy funkcji CreateColumns, a jako parametry dajemy nasze ustawienia dla kolumn oraz nasze dane.

//   - Ustawienia dla kolumn są tabelą obiektów ( każdy obiekt to następna kolumna ):
//     {
//       titleName: '',            --- nazwa całej kolumny
//       keyName: '',              --- klucz który pokrywa sie z nazwą danych które mają być wyświetlane w danej kolumnie.
//       sortType?: '',            --- czy ma być opcja sortowania, jeśli tak to jakiego typu ( możliwe opcje to 'number' / 'string' / 'date' )
//       search?: boolean;         --- czy ma być opcja szukania po tekście ( true / false )
//       actions?: [];             --- czy ma być kolumna z 'akcjami' czyli funkcjami dla danego elementu. Podczas używania tej opcji wartość keyName jest wartością która jest podawana w linku do akcji
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

// Utility functions
import { APIManager, fetcher } from '@/utils';

// Types
import type { InputRef } from 'antd';
import type { ColumnType } from 'antd/es/table';
import type { FilterConfirmProps } from 'antd/es/table/interface';
import type { TableColumns } from '@/utils';
import type { HighlighterProps } from 'react-highlight-words';

// Ant design
import { Space, Button, Input, Tag, Tooltip } from 'antd';
import { CloseOutlined, SearchOutlined } from '@ant-design/icons';

// React
import React from 'react';
import { useRef, useState } from 'react';
import Highlighter from 'react-highlight-words';
import { Link } from 'react-router-dom';
import { Key } from 'antd/lib/table/interface';

const HighlighterComponent = Highlighter as typeof React.Component<HighlighterProps>;

export function CreateColumns<DataType extends { [key: string]: string | number }>(
  columnsOptions: TableColumns[],
  linkId = 'id',
) {
  const [searchText, setSearchText] = useState('');
  const [searchedColumn, setSearchedColumn] = useState('');
  const searchInput = useRef<InputRef>(null);

  // Do przebudowania w przyszłości, zależny od zapotrzebowania w przyszłości
  const renderActions = (keyName: string, actions?: TableColumns['actions']) => {
    if (!actions || actions.length === 0) return;
    return {
      render: (_: unknown, record: DataType) => (
        <Space size="middle">
          {actions.map((action) => {
            if (action.type === 'query') {
              return (
                // eslint-disable-next-line jsx-a11y/click-events-have-key-events, jsx-a11y/no-noninteractive-element-interactions
                <p
                  key={action.title}
                  style={{ color: action.color, cursor: 'pointer', margin: '0' }}
                  onClick={async () => {
                    await fetcher(
                      `${APIManager.baseAPIRUrl}${action.link}${record['id']}`,
                      {
                        method: 'POST',
                        returnVoid: true,
                        body: {
                          box_id: record['id'],
                        },
                      },
                    );
                    if (action.callback) action.callback();
                  }}
                >
                  {action.title}
                </p>
              );
            }
            if (action.buttonType === 'tooltip') {
              return (
                <Link
                  to={action.link ? `${action.link}${record[linkId]}` : '#'}
                  key={action.title}
                >
                  <Tooltip title={action.title}>
                    <Button
                      shape="circle"
                      size="small"
                      style={{
                        borderColor: 'gray',
                        color: action.color,
                      }}
                      icon={action.icon}
                    ></Button>
                  </Tooltip>
                </Link>
              );
            }
            return (
              <Link
                to={action.link ? `${action.link}${record['id']}` : '#'}
                key={action.title}
              >
                <Button
                  size="small"
                  style={{
                    outline: action.color,
                    color: action.color,
                    boxSizing: 'content-box',
                    padding: '0.1rem 0.3rem',
                  }}
                  icon={action.icon}
                  type={action.buttonType ? action.buttonType : 'default'}
                >
                  {action.title}
                </Button>
              </Link>
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
    } else if (sortType === 'time') {
      return {
        sorter: {
          compare: (a: DataType, b: DataType) =>
            collator.compare(
              a[keyName as keyof DataType] as string,
              b[keyName as keyof DataType] as string,
            ),
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

    const handleReset = (confirm: (param?: FilterConfirmProps) => void, setSelectedKeys: (key: Key[]) => void) => {
      setSearchText('');
      setSearchedColumn('');
      setSelectedKeys([]);
      confirm();
    };

    return {
      filterDropdown: ({
        setSelectedKeys,
        selectedKeys,
        confirm,
        close
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
            value={selectedKeys[0]?.toString()}
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
              onClick={() => handleReset(confirm, setSelectedKeys)}
              style={{ width: 90 }}
            >
              Reset
            </Button>
            <Button type="link" style={{ color: '#fff' }} onClick={close}>
              <CloseOutlined />
            </Button>
          </Space>
        </Space>
      ),
      filterIcon: (filtered: boolean) => (
        <SearchOutlined style={{ color: filtered ? '#1890ff' : undefined }} />
      ),
      onFilter: (value, record: DataType) => {
        if (record[dataIndex] == null) {
          return false;
        }
        return record[dataIndex]
          .toString()
          .toLowerCase()
          .includes((value as string).toLowerCase());
      },
      onFilterDropdownOpenChange: (visible) => {
        if (visible) {
          searchInput.current?.select();
        }
      },
      render: (text) =>
        searchedColumn === dataIndex ? (
          <HighlighterComponent
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
        let color, description;
        if (record[status.key] === status.options.on.value) {
          color = '#429445';
          description = status.options.on.description;
        } else if (record[status.key] === status.options.off.value) {
          color = '#f5222d';
          description = status.options.off.description;
        }
        return (
          <Tag color={color} key={record[status.key]}>
            {description}
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
      ...getColumnSearchProps(column.keyName, column.search),
      ...setStatus(column.status),
      ...getSorter(column.sortType, column.keyName),
      ...renderActions(column.keyName, column.actions),
      ...getFixed(column.fixed, column.width),
      ...renderText(column.keyName, column.beforeText, column.afterText),
    };
  });
}
