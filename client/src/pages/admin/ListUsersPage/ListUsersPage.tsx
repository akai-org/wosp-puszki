// React
import { useEffect } from 'react';

// Utility functions
import type { TableColumns, UserDataType } from '@/utils';
import { CreateColumns } from '@/utils';

// Style and ant design
import s from '../AdminPage.module.less';
import { Typography, Space, Layout, Table } from 'antd';

const { Title } = Typography;
const { Content } = Layout;

export const ListUsersPage = () => {
  // testowe dane
  const data: UserDataType[] = [
    {
      user_id: 'Wosp1',
      name: 'Pan Paweł',
      role: 'user',
    },
    {
      user_id: 'Wosp2',
      name: 'Walaszek',
      role: 'admin',
    },
    {
      user_id: 'Wosp3',
      name: 'Kapitan Bomba',
      role: 'superadmin',
    },
  ];

  // Ustawienia dla poszczególnych kolumn
  const columnsOptions: TableColumns[] = [
    {
      titleName: 'Nazwa użytkownika',
      keyName: 'name',
      sortType: 'string',
      search: true,
      width: 100,
    },
    {
      titleName: 'Rola',
      keyName: 'role',
      sortType: 'string',
      search: true,
      width: 150,
    },
    {
      titleName: 'Akcje',
      keyName: 'user_id',
      fixed: 'right',
      width: 100,
      actions: [
        {
          title: 'Zmień hasło',
          link: '/admin/changepassword/',
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
          <Title level={4}>Lista użytkowników</Title>
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
