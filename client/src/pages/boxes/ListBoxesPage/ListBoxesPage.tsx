// Utility functions
import type { TableColumns } from '@/utils';
import { APIManager, CreateColumns, fetcher, useGetAllBoxesQuery } from '@/utils';

// Style and ant design
import s from '../BoxesPage.module.less';
import { Typography, Space, Layout, Table } from 'antd';
import { createDisplayableBoxData } from '@/utils/Functions/createRefactorData';
import { Outlet } from 'react-router-dom';
import { useMutation } from '@tanstack/react-query';
import { IconButton } from '@/components';

const { Title } = Typography;
const { Content } = Layout;

export const ListBoxesPage = () => {
  const { data } = useGetAllBoxesQuery();

  // Ustawienia dla poszczególnych kolumn
  const columnsOptions: TableColumns[] = [
    {
      titleName: 'Puszka',
      keyName: 'id',
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
      titleName: 'PLN',
      keyName: 'amount_PLN',
      sortType: 'number',
      width: 100,
      afterText: 'PLN',
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
      titleName: 'Status',
      keyName: 'status',
      width: 200,
      status: {
        key: 'status',
        options: {
          on: { value: 'settled', description: 'Rozliczona' },
          off: { value: 'unsettled', description: 'Nierozliczona' },
        },
      },
    },
    {
      titleName: 'Inne',
      keyName: 'id',
      beforeText: 'Puszka nr.',
      width: 175,
    },
    {
      titleName: 'Godzina wydania',
      keyName: 'give_hour',
      sortType: 'time',
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
          link: '/liczymy/boxes/listBoxes/show/',
          color: '#1890FF',
          type: 'link',
        },
      ],
    },
  ];

  const displayableData = createDisplayableBoxData(data);
  // Tworzenie kolumn
  const columns = CreateColumns(columnsOptions);

  const mutation = useMutation({
    mutationFn: () =>
      fetcher<Blob>(`${APIManager.baseAPIRUrl}/charityBoxes/csv`, { returnBlob: true }),
    onSuccess: (data) => {
      const url = window.URL.createObjectURL(new Blob([data]));
      const link = document.createElement('a');
      link.href = url;
      link.setAttribute(
        'download',
        `charity_boxes${(Math.random() * 10000000000).toFixed(0)}.csv`,
      );
      document.body.appendChild(link);
      link.click();
    },
    onError: (error) => {
      console.log(error);
    },
  });

  return (
    <Layout>
      <IconButton
        style={{ marginLeft: 'auto', alignSelf: 'flex-end', marginRight: '1.25rem' }}
        onClick={() => mutation.mutate()}
      >
        Eksportuj dane
      </IconButton>
      <Content className={s.content}>
        <Space direction="vertical" size="small" className={s.space}>
          <Title level={4}>Lista puszek</Title>
          <Table
            size="middle"
            columns={columns}
            pagination={false}
            dataSource={displayableData}
            rowKey="id" // To należy zmienić przy okazji podłączenia API
            scroll={{ y: '70vh' }}
            rowClassName={s.table_row}
          />
        </Space>
        <Outlet />
      </Content>
    </Layout>
  );
};
