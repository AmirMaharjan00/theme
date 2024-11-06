const { Dropdown, Tooltip, Button, TextControl, Dashicon } = wp.components;
const { useState, useEffect, useMemo } = wp.element;
const { escapeHTML } = wp.escapeHtml;
const { __ } = wp.i18n;
const { customize } = wp;
import { BlogmaticControlHeader, useBlogmaticColorPresets } from './component-function'
import { DndContext, closestCenter, useSensors, useSensor, MouseSensor } from '@dnd-kit/core';
import { SortableContext, useSortable, arrayMove, verticalListSortingStrategy } from '@dnd-kit/sortable';
import { CSS } from '@dnd-kit/utilities';
import { BlogmaticReusableColorComponent } from './colorComponent'

export const BlogmaticSocialShare = ( props ) => {
    const [ value, setValue ] = useState( props.value )
    const { label, description, library, default:DEFAULT, ...controlValues } = customize.settings.controls[props.setting]

    const sensors = useSensors(
        useSensor( MouseSensor, {
            // Require the mouse to move by 3 pixels before activating
            activationConstraint: {
                distance: 3
            }
        })
    );

    const valueMapping = ( val ) => {
        return val.map(( current ) => {
            const { icon } = current
            return icon
        })
    }    
    
    const filteredLibrary = useMemo(() => {
        const iconPicker = valueMapping( value )
        // generate label for already picked icons
        let activeIconsLabelList = Object.entries( library ).map(( [ currentKey, currentValue ] ) => {
            if( iconPicker.includes( currentKey ) ) return currentValue.label
        })

        // filter out remaining icons
        let tempFilteredIconsArray = Object.entries( library ).filter(( [ currentKey, currentValue ] ) => {
            if( ! activeIconsLabelList.includes( currentValue.label ) ) return [ currentKey, currentValue ]
        })
        return Object.fromEntries( tempFilteredIconsArray )
    }, [ value ])

    useEffect(() => {
        customize.value( props.setting )( value )
    }, [ value ])

    /**
     * Add new item to list
     * 
     * @since 1.0.0
     */
    const handleAddToList = () => {
        let toAppendIndex = Math.floor( Math.random() * Object.keys( filteredLibrary ).length )
        let randomIcon = Object.keys( filteredLibrary )[toAppendIndex]
        setValue([ ...value, { ...value[ value.length - 1 ], 'icon': randomIcon } ])
    }

    /**
     * Remove item from list
     * 
     * @since 1.0.0
     */
    const handleRemoveFromList = ( index ) => {
        setValue([ ...value.slice( 0, index ), ...value.slice( index + 1 ) ])
    }

    /**
     * Event that fires on drag on
     * 
     * @since 1.0.0
     */
    function handleDragEnd( event ) {
        const { active, over } = event;
        const OLDINDEX = value.findIndex(( item ) => item === active.id )
        const NEWINDEX = value.findIndex(( item ) => item === over.id )
        if ( active.id !== over.id ) setValue( arrayMove( value, OLDINDEX, NEWINDEX ) )
    }

    // MARK: MAIN RETURN
    return(
        <div className="field-main">
            <BlogmaticControlHeader label={ label } description={ description } />
            <DndContext
                collisionDetection = { closestCenter }
                onDragEnd = { handleDragEnd }
                sensors = { sensors }
            >
                <SortableContext 
                    items = { value }
                    strategy = { verticalListSortingStrategy }
                >
                    <div className="items-wrap">
                        { value.map(( current, index ) => {
                            return <SortableItem
                                key = { index } // unique id
                                _thisValue = { current } 
                                index = { index }
                                value = { value }
                                setValue = { setValue }
                                removeFromList = { handleRemoveFromList }
                                originalLibrary = { library }
                                library = { filteredLibrary }
                                controlValues = { controlValues }
                                default = { DEFAULT[index] }
                                showTrash = { value.length > 1 }
                            />
                        }) } 
                    </div>
                </SortableContext>
            </DndContext>
            <Button variant="primary" icon="plus" className="add-to-list" onClick={ handleAddToList } >{ __('Add', 'blogmatic-pro') }</Button>
        </div>
    );
}

/**
 * Create sortable items
 * 
 * @since 1.0.0
 */
const SortableItem = ( props ) => {
    const { _thisValue, value, index, library, originalLibrary, controlValues, default: DEFAULT, showTrash } = props
    const { icon, color, background } = _thisValue
    const [ activeDropdownIcon, setActiveDropdownIcon ] = useState( false )
    const { to_include: toInclude, color_genre: colorGenre, color_hover: colorHover, background_genre: backgroundGenre, background_hover: backgroundHover } = controlValues
    const {
        attributes,
        listeners,
        setNodeRef,
        transform,
        transition
    } = useSortable({ id: _thisValue });

    const style = {
        transform: CSS.Transform.toString( transform ),
        transition
    };

    const updateColor = ( newColor ) => {
        props.setValue([ ...value.slice( 0, index ), { ..._thisValue, 'color': newColor }, ...value.slice( index + 1 ) ])
    }

    const updateBackground = ( newBackground ) => {
        props.setValue([ ...value.slice( 0, index ), { ..._thisValue, 'background': newBackground }, ...value.slice( index + 1 ) ])
    }

    const updateIcon = ( newIcon ) => {
        props.setValue([ ...value.slice( 0, index ), { ..._thisValue, 'icon': newIcon }, ...value.slice( index + 1 ) ])
    }

    const handleReset = () => {
        props.setValue([ ...value.slice( 0, index ), DEFAULT, ...value.slice( index + 1 ) ])
    }

    /* Dropdown icon click */
    const handleDropdownIconClick = () => {
        setActiveDropdownIcon( ! activeDropdownIcon )
    }

    return (
        <div ref={ setNodeRef } style={ style } { ...attributes } { ...listeners } className={ "item" + ( activeDropdownIcon ? ' active' : '' ) }>
            <div className='social-share-wrapper'>
                { <span className="current-icon-label">{ originalLibrary[icon].label }</span> }

                <div className='social-icon-dropdown-wrapper'>
                    <Dashicon icon='image-rotate' className="reset-button" onClick={() => handleReset()}/>
                    <span className="current-icon-label"><i className={ icon }></i></span>
                    <Dashicon icon={ activeDropdownIcon ? 'arrow-down-alt2' : 'arrow-up-alt2' } className="social-share-dropdown" onClick={ handleDropdownIconClick }/>
                </div>
            </div>

            { activeDropdownIcon && <div className='dropdown-wrapper'>
                { toInclude.includes( 'icons' ) && <SocialShareComponent 
                    library = { library }
                    icon = { icon }
                    updateIcon = { updateIcon }
                    color = { color }
                    background = { background }
                /> }
                <div className='color-wrapper color-field'>
                    <BlogmaticReusableColorComponent
                        label = 'Color'
                        value = { color }
                        menus = { colorGenre }
                        hover = { colorHover }
                        setValue = { updateColor }
                    />
                </div>
                <div className='background-wrapper color-field'>
                    <BlogmaticReusableColorComponent
                        label = 'Background'
                        value = { background }
                        menus = { backgroundGenre }
                        hover = { backgroundHover }
                        setValue = { updateBackground }
                    />
                </div>
                { showTrash && <Button className="remove-from-list" onClick={() => props.removeFromList( index ) } >{ 'Remove' }</Button> }
            </div> }
        </div>
    )
}

/**
 * Social Share Component
 * MARK: SOCIAL SHARE COMPONENT
 */
const SocialShareComponent = ( props ) => {
    const { library, icon, color, background } = props
    const [ searchedText, setSearchedText ] = useState( '' )
    const [ tempIconsArray, setTempIconsArray ] = useState({})
    const [ currentIcon, setCurrentItemValue ] = useState( '' )
    const [ isHover, setIsHover ] = useState( false )
    const { getColorsAndVariables } = useBlogmaticColorPresets()
    const allVariables = getColorsAndVariables()
    
    /* Get color */
    const getColor = ( col ) => {
        return allVariables[ col ] === undefined ? col : allVariables[ col ]
    }

    const INITIAL = {
        color: getColor( color.initial[color.initial.type] ),
        background: getColor( background.initial[background.initial.type] )
    }
    const HOVER = {
        color: getColor( color.hover[color.hover.type] ),
        background: getColor( background.hover[background.hover.type] )
    }

    useEffect(() => {
        if( currentIcon !== '' ) props.updateIcon( currentIcon )
    }, [ currentIcon ])

    /**
     * search function
     * 
     * @since 1.0.0
     */
    const updateSearchedState = ( data ) => {
        setSearchedText( data )
        var searchedIcons = Object.entries( library ).filter(( [ currentKey, currentValue ] ) => {
            return currentKey.toLowerCase().includes( data.toLowerCase() )
        })
        setTempIconsArray( Object.keys( Object.fromEntries( searchedIcons ) ) )
    }

    return (
        <Dropdown
            popoverProps={{ resize:false, noArrow:false, flip:true, variant:"unstyled", placement:'bottom-end' }}
            contentClassName="blogmatic-social-share-control-popover blogmatic-social-share-icon-popover"
            renderToggle={ ( { isOpen, onToggle } ) => (
                <Tooltip placement="top" delay={ 200 } text={ __( escapeHTML( 'Icon Picker' ), 'blogmatic-pro' ) }>
                    <span className='color-indicator-wrapper'>
                        <span style={ isHover ? HOVER : INITIAL } onClick={ onToggle } onMouseEnter={() => setIsHover( true )} onMouseLeave={() => setIsHover( false )} aria-expanded={ isOpen } className="current-icon"><i className={ icon }></i></span>
                    </span>
                </Tooltip>
            ) }
            renderContent = {() => <div className="icon-picker-container">
                <TextControl
                    value = { searchedText }
                    onChange = { ( data ) => updateSearchedState( data ) }
                    onKeyUp = { ( data ) => updateSearchedState( data.target.value ) }
                    placeHolder = { __( escapeHTML( 'Type to search' ), 'blogmatic-pro' ) }
                />
                <div className="social-share-icons">
                    { ( searchedText === '' ? Object.keys( library ) : tempIconsArray ).map(( icon, index ) => {
                        return( <span key={ index } className='social-share' onClick={() => setCurrentItemValue( icon )}><i className={ icon }></i></span> );
                    }) }
                </div>
            </div>}
        />
    );
}