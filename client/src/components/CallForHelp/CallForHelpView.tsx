import React, { useState } from 'react';
import s from './CallForHelpView.module.less';
import { NotificationOutlined } from '@ant-design/icons';
import { Button } from 'antd';
import { useMutation } from '@tanstack/react-query';
import { APIManager, fetcher } from '@/utils';
import { Spinner } from '@components/Layout/Spinner/Spinner';

export const CallForHelpView = () => {
  const [helpCalled, setHelpCalled] = useState(false);
  const [show, setShow] = useState(false);
  const [isLoading, setIsLoading] = useState(false);

  const requestHelp = useMutation({
    mutationFn: () =>
      fetcher(APIManager.helpRequestUrl, {
        method: 'POST',
      }),
    onSuccess: () => {
      setHelpCalled(true);
      setIsLoading(false);
    },
    onError: () => {
      setIsLoading(false);
    },
  });

  const resolveHelpRequest = useMutation({
    mutationFn: () =>
      fetcher(APIManager.helpResolveUrl, {
        method: 'POST',
      }),
    onSuccess: () => {
      setHelpCalled(false);
      setIsLoading(false);
    },
    onError: () => {
      setIsLoading(false);
    },
  });

  const toggleHelp = async () => {
    setIsLoading(true);
    if (!helpCalled) {
      return requestHelp.mutate();
    }
    return resolveHelpRequest.mutate();
  };

  const getButtonContent = () => {
    if (isLoading) {
      return <Spinner />;
    }
    if (helpCalled) {
      return 'Nie potrzebuje już pomocy';
    }
    return 'Zawołaj po pomoc';
  };

  return (
    <div className={[s.callForHelpView, show ? s.show : ''].join(' ')}>
      <div className={[s.iconBox, show ? s.show : ''].join(' ')}>
        <NotificationOutlined className={s.icon} onClick={() => setShow(!show)} />
        <p>Pomoc</p>
      </div>
      <div className={s.body}>
        <div className={s.bodyTop}>
          <Button type="primary" className={s.button} onClick={toggleHelp}>
            {getButtonContent()}
          </Button>
        </div>
      </div>
    </div>
  );
};
