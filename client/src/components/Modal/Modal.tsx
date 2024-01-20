import { Button, Layout, Space } from 'antd';
import s from './Modal.module.less';
import Title from 'antd/lib/typography/Title';
import { Icon } from '@iconify/react';
import { useNavigate } from 'react-router-dom';
import { Header } from 'antd/lib/layout/layout';
import { useEffect } from 'react';
import { useSidebarStateContext } from '@/utils';

export const Modal = ({
  children,
  title,
  backRoute,
}: {
  children: JSX.Element;
  title: string;
  backRoute?: string;
}) => {
  const navigate = useNavigate();
  const { show } = useSidebarStateContext();

  useEffect(() => {
    document.body.style.overflowY = 'hidden';
    return () => {
      document.body.style.overflowY = 'scroll';
    };
  }, []);

  return (
    <Layout className={[s.wrapper, show ? s.sidebarShown : s.sidebarHidden].join(' ')}>
      <Space direction="vertical" className={s.container}>
        <Header className={s.header}>
          <Title level={4} className={s.title}>
            {title}
          </Title>
          <Button
            className={s.backButton}
            type="primary"
            onClick={() => (backRoute ? navigate(backRoute) : navigate(-1))}
          >
            <Icon
              className={s.logOutButtonInside_icon}
              icon="ic:round-log-out"
              color="#FFFFFF"
              width="20"
              height="20"
            />
          </Button>
        </Header>
        <Space className={s.content}>{children}</Space>
      </Space>
    </Layout>
  );
};
