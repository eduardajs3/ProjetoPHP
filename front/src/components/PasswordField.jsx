/* eslint-disable react/display-name */
import React, { useState } from 'react';
import { Input } from '@headlessui/react';
import { Eye, EyeOff, CircleAlert } from 'lucide-react';

export const PasswordField = React.forwardRef(({ error, ...inputProps }, ref) => {
  const [show, setShow] = useState(false);

  return (
    <div className="flex flex-col gap-3">
      <div
        className={`flex flex-row items-center border border-1 border-border rounded text-sm placeholder-placeholder text-inputText inset-0 focus-within:border-2 focus-within:border-outline ${error && 'border-borderError'}`}
      >
        <Input
          ref={ref}
          type={show ? 'text' : 'password'}
          {...inputProps}
          className="py-4 px-3 w-full outline-none rounded"
        />
        <button type="button" className="mx-3 bg-transparent" onClick={() => setShow(!show)}>
          {show ? (
            <Eye className="text-placeholder" />
          ) : (
            <EyeOff className="text-placeholder" />
          )}
        </button>
      </div>
      {error && (
        <div className="flex flex-row items-center gap-2">
          <CircleAlert className="text-textError" size={16} />
          <span className="block text-textError text-[12px]">{error.message}</span>
        </div>
      )}
    </div>
  );
});