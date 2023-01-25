// React
import { useEffect } from 'react';

// Utility functions
import type { TableColumns, VolunteerDataType } from '@/utils';
import { CreateColumns } from '@/utils';

// Style and ant design
import s from '../AdminPage.module.less';
import { Typography, Space, Layout, Table } from 'antd';

const { Title } = Typography;
const { Content } = Layout;

export const ListVolunteersPage = () => {
  // testowe dane
  const data: VolunteerDataType[] = [
    {
      volunteer_id: 103,
      name: 'Pan',
      sur_name: 'Paweł',
      id: '114',
      amount_PLN: 10042.7,
      status: 'unsettled',
    },
    {
      volunteer_id: 104,
      name: 'Łukasz',
      sur_name: 'Walaszek',
      id: '154',
      amount_PLN: 3022.1,
      status: 'settled',
    },
    {
      volunteer_id: 105,
      name: 'Kapitan',
      sur_name: 'Bomba',
      id: '169',
      amount_PLN: 2445.7,
      status: 'settled',
    },
  ];

  // Ustawienia dla poszczególnych kolumn
  const columnsOptions: TableColumns[] = [
    {
      titleName: 'Numer ID',
      keyName: 'volunteer_id',
      sortType: 'number',
      search: true,
      width: 100,
    },
    {
      titleName: 'Imię',
      keyName: 'name',
      sortType: 'string',
      search: true,
      width: 150,
    },
    {
      titleName: 'Nazwisko',
      keyName: 'sur_name',
      sortType: 'string',
      search: true,
      width: 150,
    },
    {
      titleName: 'Nr. Identyfikatora',
      keyName: 'id',
      sortType: 'number',
      width: 150,
    },
    {
      titleName: 'Kwota zebrana ( tylko PLN )',
      keyName: 'amount_PLN',
      sortType: 'number',
      width: 250,
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
          <Title level={4}>Lista wolontariuszy</Title>
          <Table
            size="middle"
            columns={columns}
            pagination={false}
            dataSource={data}
            rowKey="volunteer_id" // To należy zmienić przy okazji podłączenia API
            scroll={{ y: '70vh' }}
            rowClassName={s.table_row}
          />
        </Space>
      </Content>
    </Layout>
  );
};
