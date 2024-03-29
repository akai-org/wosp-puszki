// Utility functions
import type { TableColumns } from '@/utils';
import { CreateColumns } from '@/utils';

// Style and ant design
import s from '../AdminPage.module.less';
import { Typography, Space, Layout, Table } from 'antd';

const { Title } = Typography;
const { Content } = Layout;

import { useGetUsersQuery } from '@/utils';
import { createUsersData } from '@/utils/Functions/createUserData';

export const ListUsersPage = () => {
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
  ];

  // Pobieranie danych
  const { data } = useGetUsersQuery();
  const usersData = createUsersData(data);

  // Tworzenie kolumn
  const columns = CreateColumns(columnsOptions);

  return (
    <Layout>
      <Content className={s.content}>
        <Space direction="vertical" size="small" className={s.space}>
          <Title level={4}>Lista użytkowników</Title>
          <Table
            size="middle"
            columns={columns}
            pagination={false}
            dataSource={usersData}
            rowKey="user_id" // To należy zmienić przy okazji podłączenia API
            scroll={{ y: '70vh' }}
            rowClassName={s.table_row}
          />
        </Space>
      </Content>
    </Layout>
  );
};
