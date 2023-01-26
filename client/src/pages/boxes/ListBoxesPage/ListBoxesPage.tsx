// React
import { useEffect } from 'react';

// Utility functions
import type { TableColumns, BoxDataType } from '@/utils';
import { CreateColumns } from '@/utils';

// Style and ant design
import s from '../BoxesPage.module.less';
import { Typography, Space, Layout, Table } from 'antd';

const { Title } = Typography;
const { Content } = Layout;

export const ListBoxesPage = () => {
  // testowe dane
  const data: BoxDataType[] = [
    {
      box_id: '1',
      volunteer_id: 103,
      name: 'Pan Paweł',
      amount_EUR: 10.5,
      amount_GBP: 34.6,
      amount_USD: 100,
      amount_PLN: 1042.7,
      status: 'settled',
      give_hour: '2023-02-01 13:34:02',
    },
    {
      box_id: '2',
      volunteer_id: 84,
      name: 'Susanna Mamun',
      amount_EUR: 15.5,
      amount_GBP: 14.6,
      amount_USD: 150,
      amount_PLN: 1742.7,
      status: 'unsettled',
      give_hour: '2022-01-14 12:14:45',
    },
    {
      box_id: '3',
      volunteer_id: 38,
      name: 'Dobrosława Pola',
      amount_EUR: 60.1,
      amount_GBP: 7.6,
      amount_USD: 530,
      amount_PLN: 742.7,
      status: 'settled',
      give_hour: '2023-01-11 13:23:10',
    },
  ];

  // Ustawienia dla poszczególnych kolumn
  const columnsOptions: TableColumns[] = [
    {
      titleName: 'Puszka',
      keyName: 'box_id',
      sortType: 'number',
      search: true,
      fixed: 'left',
      width: 80,
    },
    {
      titleName: 'Numer ID wolontariusza',
      keyName: 'volunteer_id',
      sortType: 'number',
      search: true,
      fixed: 'left',
      width: 200,
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
      titleName: 'Status',
      keyName: 'status',
      width: 200,
      status: {
        key: 'status',
        options: {
          on: { value: 'settled', description: 'Rozliczona' },
          off: { value: 'unsettled', description: 'Nie Rozliczona' },
        },
      },
    },
    {
      titleName: 'Inne',
      keyName: 'box_id',
      beforeText: 'Puszka nr.',
      width: 175,
    },
    {
      titleName: 'Godzina wydania',
      keyName: 'give_hour',
      sortType: 'date',
      width: 200,
    },
    {
      titleName: 'Actions',
      keyName: 'actions',
      fixed: 'right',
      width: 100,
      actions: [
        {
          title: 'Podgląd',
          link: '/countedBoxes/boxesApproved/show/',
          color: '#1890FF',
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
          <Title level={4}>Lista puszek</Title>
          <Table
            size="middle"
            columns={columns}
            pagination={false}
            dataSource={data}
            rowKey="box_id" // To należy zmienić przy okazji podłączenia API
            scroll={{ y: '70vh' }}
            rowClassName={s.table_row}
          />
        </Space>
      </Content>
    </Layout>
  );
};
