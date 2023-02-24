import { notification } from 'antd';

type NotificationType = 'success' | 'info' | 'warning' | 'error';

export const openNotification = (
  type: NotificationType,
  message: string,
  description = '',
) => {
  notification[type]({
    message: message,
    description: description,
    duration: 2,
    style: {
      width: 600,
      fontFamily: 'Poppins',
      fontWeight: 500,
      borderRadius: 10,
    },
  });
};
