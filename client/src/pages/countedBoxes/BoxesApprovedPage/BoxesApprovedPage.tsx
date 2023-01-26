// React
import { useEffect } from 'react';

// Utility functions
import type { TableColumns, DataType } from '@/utils';
import { CreateColumns } from '@/utils';

// Style and ant design
import s from './BoxesPage.module.less';
import { Typography, Space, Layout, Table } from 'antd';

const { Title } = Typography;
const { Content } = Layout;

export const BoxesApprovedPage = () => {
  // testowe dane
  const data: DataType[] = [
    {
      key: '1',
      name: 'C John Brown',
      amount_EUR: 2.41,
      amount_GBP: 1.61,
      amount_USD: 7.91,
      amount_PLN: 1004,
      more: 'Puszka nr. 13',
      position: 'Stanowisko 1',
      time_counted: '2023-02-01',
      is_confirmed: 0,
    },
    {
      key: '2',
      name: 'B John Brown',
      amount_EUR: 22.41,
      amount_GBP: 16.61,
      amount_USD: 76.91,
      amount_PLN: 1604,
      more: 'Puszka nr. 13',
      position: 'Stanowisko 1',
      time_counted: '2022-02-01',
      is_confirmed: 1,
    },
    {
      key: '3',
      name: 'A John Brown',
      amount_EUR: 22.41,
      amount_GBP: 16.61,
      amount_USD: 76.91,
      amount_PLN: 1604,
      more: 'Puszka nr. 13',
      position: 'Stanowisko 1',
      time_counted: '2022-02-01',
      is_confirmed: 0,
    },
  ];

  // Ustawienia dla poszczególnych kolumn
  const columnsOptions: TableColumns[] = [
    {
      titleName: 'ID',
      keyName: 'key',
      sortType: 'string',
      search: true,
      fixed: 'left',
      width: 70,
    },
    {
      titleName: 'Wolontariusz',
      keyName: 'name',
      sortType: 'string',
      search: true,
      fixed: 'left',
      width: 200,
    },
    {
      titleName: 'EUR',
      keyName: 'amount_EUR',
      sortType: 'number',
      afterText: '€',
      width: 100,
    },
    {
      titleName: 'GBP',
      keyName: 'amount_GBP',
      sortType: 'number',
      afterText: '£',
      width: 100,
    },
    {
      titleName: 'USD',
      keyName: 'amount_USD',
      sortType: 'number',
      afterText: '$',
      width: 100,
    },
    {
      titleName: 'PLN',
      keyName: 'amount_PLN',
      sortType: 'number',
      width: 100,
      afterText: 'PLN',
    },
    {
      titleName: 'Inne',
      keyName: 'more',
      search: true,
      width: 200,
    },
    {
      titleName: 'Stanowisko',
      keyName: 'position',
      search: true,
      sortType: 'string',
      width: 150,
    },
    {
      titleName: 'Godzina przeliczenia',
      keyName: 'time_counted',
      sortType: 'date',
      width: 200,
    },
    {
      titleName: 'Actions',
      keyName: 'actions',
      fixed: 'right',
      width: 220,
      actions: [
        {
          title: 'Podgląd',
          link: '/countedBoxes/boxesApproved/show/',
          color: 'blue',
        },
        {
          title: 'Modyfikuj',
          link: '/countedBoxes/boxesApproved/show/',
          color: 'blue',
        },
      ],
    },
  ];

  // Tworzenie kolumn
  const columns = CreateColumns(columnsOptions, data);

  useEffect(() => {
    //fetching data here
  }, []);

  return (
    <Layout>
      <Content className={s.content}>
        <Space direction="vertical" size="small" className={s.space}>
          <Title level={4}>Zatwierdzone</Title>
          <Table
            size="middle"
            columns={columns}
            pagination={false}
            dataSource={data}
            rowKey="key" // To należy zmienić przy okazji podłączenia API
            scroll={{ y: '70vh' }}
            rowClassName={s.table_row}
          />
        </Space>
      </Content>
    </Layout>
  );
};
