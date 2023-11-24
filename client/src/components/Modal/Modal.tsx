import { Button } from 'antd';
import s from './Modal.module.less';
import Title from 'antd/lib/typography/Title';
import { Icon } from '@iconify/react';
import { useNavigate } from 'react-router-dom';

export const Modal = ({ children, title }: { children: JSX.Element, title: string }) => {

  const navigate = useNavigate();

  return (
    <div className={s.wrapper}>
      <section className={s.container}>
        <div className={s.header}>
          <div></div>
          <Title level={4} className={s.title}>
            {title}
          </Title>
          <Button
            className={s.backButton}
            type="primary"
            onClick={() => navigate(-1)}
          >
            <Icon
              className={s.logOutButtonInside_icon}
              icon="ic:round-log-out"
              color="#FFFFFF"
              width="20"
              height="20"
            />
          </Button>
        </div>
        <div className={s.content}>
          {children}
        </div>
      </section>
    </div>
  )
}