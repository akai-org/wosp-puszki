import { notification } from 'antd';

type NotificationType = 'success' | 'info' | 'warning' | 'error';

export const openNotification = (
  type: NotificationType,
  message: string,
  description = '',
  key = 'notification',
) => {
  notification[type]({
    key,
    message: message,
    description: description,
    duration: 0,
    style: {
      width: 600,
      fontFamily: 'Poppins',
      fontWeight: 500,
      borderRadius: 10,
    },
  });
};

export const closeNotification = () => {
  notification.destroy();
};
