// React
import { useEffect } from 'react';

// Utility functions
import type { TableColumns, LogDataType } from '@/utils';
import { CreateColumns } from '@/utils';

// Style and ant design
import s from '../AdminPage.module.less';
import { Typography, Space, Layout, Table } from 'antd';

const { Title } = Typography;
const { Content } = Layout;

export const LogsPage = () => {
  // testowe dane
  const data: LogDataType[] = [
    {
      user: 'superadmin',
      volunteer_id: '105',
      box: '12',
      action: 'verifed',
      other: 'Puszka zatwierdzona przez administratora',
      time: '2022-11-03T21:23:30.00000Z',
    },
    {
      user: 'superadmin',
      volunteer_id: '105',
      box: '12',
      action: 'verifed',
      other: 'Puszka zatwierdzona przez administratora',
      time: '2022-11-03T21:23:30.00000Z',
    },
    {
      user: 'superadmin',
      volunteer_id: '105',
      box: '12',
      action: 'verifed',
      other: 'Puszka zatwierdzona przez administratora',
      time: '2022-11-03T21:23:30.00000Z',
    },
  ];

  // Ustawienia dla poszczególnych kolumn
  const columnsOptions: TableColumns[] = [
    {
      titleName: 'Użytkownik',
      keyName: 'user',
      sortType: 'number',
      search: true,
      width: 100,
    },
    {
      titleName: 'Wolontariusz',
      keyName: 'volunteer_id',
      sortType: 'string',
      search: true,
      width: 100,
    },
    {
      titleName: 'Puszka',
      keyName: 'box',
      sortType: 'number',
      search: true,
      width: 100,
    },
    {
      titleName: 'Akcja',
      keyName: 'action',
      sortType: 'string',
      search: true,
      width: 150,
    },
    {
      titleName: 'Inne',
      keyName: 'other',
      sortType: 'number',
      width: 300,
    },
    {
      titleName: 'Czas',
      keyName: 'time',
      width: 200,
      sortType: 'date',
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
          <Title level={4}>Logi</Title>
          <Table
            size="middle"
            columns={columns}
            pagination={false}
            dataSource={data}
            scroll={{ y: '70vh' }}
            rowClassName={s.table_row}
          />
        </Space>
      </Content>
    </Layout>
  );
};
