// React
import { useEffect } from 'react';

// Utility functions
import type { TableColumns } from '@/utils';
import { CreateColumns, useGetLogsQuery } from '@/utils';
import { createDisplayableLogData } from '@/utils/Functions/createRefactorData';

// Style and ant design
import s from '../AdminPage.module.less';
import { Typography, Space, Layout } from 'antd';
import { CustomTable } from '@/components/CustomTable/CustomTable';

const { Title } = Typography;
const { Content } = Layout;

export const LogsPage = () => {
  // Pobieranie danych
  const { data } = useGetLogsQuery();
  const displayableData = createDisplayableLogData(data);

  // Ustawienia dla poszczególnych kolumn
  const columnsOptions: TableColumns[] = [
    {
      titleName: 'Użytkownik',
      keyName: 'name',
      sortType: 'number',
      search: true,
      width: 100,
    },
    {
      titleName: 'Wolontariusz',
      keyName: 'user_id',
      sortType: 'string',
      search: true,
      width: 100,
    },
    {
      titleName: 'Puszka',
      keyName: 'box_id',
      sortType: 'number',
      search: true,
      width: 100,
    },
    {
      titleName: 'Akcja',
      keyName: 'type',
      sortType: 'string',
      search: true,
      width: 150,
    },
    {
      titleName: 'Inne',
      keyName: 'comment',
      sortType: 'number',
      width: 300,
    },
    {
      titleName: 'Czas',
      keyName: 'created_at',
      width: 200,
      sortType: 'date',
    },
  ];

  // Tworzenie kolumn
  const columns = CreateColumns(columnsOptions);

  return (
    <Layout>
      <Content className={s.content}>
        <Space direction="vertical" size="small" className={s.space}>
          <Title level={4}>Logi</Title>
          <CustomTable
            size="middle"
            columns={columns}
            pagination={false}
            dataSource={displayableData}
            rowKey="log_id"
            scroll={{ y: '70vh' }}
            rowClassName={(record) => record.type + '-color'}
            tableKey="LogsPage_logsTable"
          />
        </Space>
      </Content>
    </Layout>
  );
};
